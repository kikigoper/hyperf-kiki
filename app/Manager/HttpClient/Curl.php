<?php
/**
 * 协程实现Curl效果，使用swoole的http-client
 */

namespace App\Manager\HttpClient;

use EasySwoole\Component\Csp;
use EasySwoole\HttpClient\HttpClient;
use Swoole\Coroutine\Channel;

class Curl
{
    const POST_ARRAY = 'array';
    const POST_JSON = 'json';
    const POST_XML = 'xml';
    const POST_FILE = 'file';

    private $timeout = 5;//总超时时间，单位：毫秒
    private $connectTimeout = 5;//连接超时时间，单位：毫秒
    private $headers = [];
    private $postType = self::POST_ARRAY; // post请求数据类型
    private $cert = null; // 请求证书
    private $sslKey = null; // 请求ssl证书

    /**
     * get请求
     * @param string $url 请求链接
     * @param array $params get请求参数
     * @return mixed
     */
    public function get($url, $params = [])
    {
        $channel = new Channel(64);
        go(function () use ($channel, $url, $params) {
            $request = new HttpClient();
            $request->setTimeout($this->timeout)->setConnectTimeout($this->connectTimeout);

            if (!empty($this->headers)) {
                $request->setHeaders($this->headers, true, false);
            }

            $response = $request->setUrl($url)->setQuery($params)->get();

            if (empty($response->getErrMsg())) {
                $contents = $response->getBody();
            } else {
                $contents = $response->getErrMsg();
            }

            unset($request);
            $this->restoreParams();

            $channel->push($contents);
        });

        return $channel->pop();
    }

    /**
     * post请求
     * @param string $url 请求链接
     * @param string|array $data post请求参数
     * @param array $params get请求参数
     * @return mixed
     */
    public function post($url, $data, $params = [])
    {
        $channel = new Channel(64);
        go(function () use ($channel, $url, $data, $params) {
            $request = new HttpClient();
            $request->setTimeout($this->timeout)->setConnectTimeout($this->connectTimeout);

            if (!empty($this->headers)) {
                $request->setHeaders($this->headers, true, false);
            }

            if (!empty($this->cert)) {
                $request->setSslCertFile($this->cert);
            }

            if (!empty($this->sslKey)) {
                $request->setSslKeyFile($this->sslKey);
            }

            $request->setUrl($url)->setQuery($params);

            switch ($this->postType) {
                case self::POST_JSON:
                    $response = $request->postJson($data);
                    break;
                case self::POST_XML:
                    $response = $request->postXml($data);
                    break;
                case self::POST_FILE:
                    $fileArray = [];
                    foreach ($data as $k => $v) {
                        if (is_file($v)) {
                            $fileArray[$k] = new \CURLFile($v);
                        } else {
                            $fileArray[$k] = $v;
                        }
                    }
                    $response = $request->post($fileArray);
                    break;
                case self::POST_ARRAY:
                default:
                    $response = $request->post($data);
                    break;
            }

            if (empty($response->getErrMsg())) {
                $contents = $response->getBody();
            } else {
                $contents = $response->getErrMsg();
            }

            unset($request);
            $this->restoreParams();

            $channel->push($contents);
        });

        return $channel->pop();
    }

    // getJson
    public function getJson($url, $params = [])
    {
        $responseData = $this->get($url, $params);
        $result = json_decode($responseData, 1);

        if (empty($result)) {
            return $responseData;
        }

        return $result;
    }

    // postJson
    public function postJson($url, $data, $params = [])
    {
        $responseData = $this->post($url, $data, $params);
        $result = json_decode($responseData, 1);

        if (empty($result)) {
            return $responseData;
        }

        return $result;
    }

    //multi get
    public function getMulti($urlArray)
    {
        $channel = new Channel(64);
        go(function () use ($channel, $urlArray) {
            $csp = new Csp();

            foreach ($urlArray as $key => $url) {
                $csp->add($key, function () use ($url) {
                    return $this->getJson($url);
                });
            }

            $channel->push($csp->exec());
        });

        return array_values($channel->pop());
    }

    //multi post
    public function postMulti($url, $dataArray, $params = [])
    {
        $url = $this->buildUrl($url, $params);
        $channel = new Channel(64);
        go(function () use ($channel, $url, $dataArray) {
            $csp = new Csp();

            foreach ($dataArray as $key => $data) {
                $csp->add($key, function () use ($url, $data) {
                    return $this->postJson($url, $data);
                });
            }

            $resp = $csp->exec();
            $channel->push($resp);
        });

        return array_values($channel->pop());
    }

    /**
     * 设置超时时间
     * @param int $timeout 超时时间
     * @return $this
     */
    public function setTimeOut(int $timeout = 5)
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * 设置连接时间
     * @param int $connectTimeout 连接时间
     * @return $this
     */
    public function setConnectionTimeout(int $connectTimeout = 5)
    {
        $this->connectTimeout = $connectTimeout;
        return $this;
    }

    /**
     * @param array $header
     * @return $this
     */
    public function setHeaders($header = [])
    {
        $this->headers = $header;
        return $this;
    }

    /**
     * @param string $postType
     * @return $this
     */
    public function setPostType($postType = self::POST_ARRAY)
    {
        $this->postType = $postType;
        return $this;
    }

    /**
     * 设置请求证书
     * @param string $cert 证书路径
     * @return $this
     */
    public function setCert($cert)
    {
        $this->cert = $cert;
        return $this;
    }

    /**
     * 设置请求SSL证书
     * @param string $sslKey 证书路径
     * @return $this
     */
    public function setSSLKey($sslKey)
    {
        $this->sslKey = $sslKey;
        return $this;
    }

    //get参数拼接到url后
    private function buildUrl($url, $data = [])
    {
        $parsed = parse_url($url);

        isset($parsed['query']) ? parse_str($parsed['query'], $parsed['query']) : $parsed['query'] = [];

        $params = isset($parsed['query']) ? $data + $parsed['query'] : $data;
        $parsed['query'] = ($params) ? '?' . http_build_query($params) : '';
        if (!isset($parsed['path'])) {
            $parsed['path'] = '/';
        }

        $parsed['port'] = isset($parsed['port']) ? ':' . $parsed['port'] : '';

        return $parsed['scheme'] . '://' . $parsed['host'] . $parsed['port'] . $parsed['path'] . $parsed['query'];
    }

    // 还原变量
    private function restoreParams()
    {
        $this->timeout = 5;
        $this->connectTimeout = 5;
        $this->headers = [];
        $this->cert = null;
        $this->sslKey = null;
        $this->postType = self::POST_ARRAY;
    }
}