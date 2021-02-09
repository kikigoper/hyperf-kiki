<?php
/**
 * Created by PhpStorm.
 * User: kai
 * Date: 2021/2/9
 */

namespace App\Manager\HttpClient;

use Hyperf\Guzzle\ClientFactory;

use GuzzleHttp\Client;
use Hyperf\Guzzle\CoroutineHandler;
use GuzzleHttp\HandlerStack;

class GuzzleHttp {

    private $client;

    public function __construct()
    {
        $client = new Client([
            'base_uri' => '',
            'handler' => HandlerStack::create(new CoroutineHandler()),
            'timeout' => 10,
            'swoole' => [
                'timeout' => 10, // 会覆盖上面的timeout
                'socket_buffer_size' => 1024 * 1024 * 2,
            ],
        ]);

        $this->client = $client;
    }

    public function get($url, $params = [], $method = 'GET')
    {
        return $this->curl($url, $params, $method);
    }

    public function post($url, $params = [], $method = 'POST')
    {
        return $this->curl($url, $params, $method);
    }

    public function getJson($url, $params = [])
    {
        $data = $this->get($url, $params);
        return json_decode($data, 1);
    }

    public function postJson($url, $params = [])
    {
        $data = $this->post($url, $params);
        return json_decode($data, 1);
    }

    public function curl($url = '', $params = [], $method = 'GET')
    {

        $key = ($method == 'GET') ? 'query' : 'form_params';

        $response = $this->client->request($method, $url, [
            $key => $params
        ]);

        return $response->getBody();
    }
}