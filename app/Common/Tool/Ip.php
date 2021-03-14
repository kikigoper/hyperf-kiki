<?php
/**
 * Created by PhpStorm.
 * User: Qi
 * Date: 2021/3/11
 */

namespace App\Common\Tool;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Di\Annotation\Inject;

class Ip
{
    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    public function getClientIp()
    {
        $res = $this->request->getServerParams();
        if (isset($res['http_client_ip'])) {
            $ip = $res['http_client_ip'];
        } elseif (isset($res['http_x_real_ip'])) {
            $ip = $res['http_x_real_ip'];
        } elseif (isset($res['http_x_forwarded_for'])) {
            //部分CDN会获取多层代理IP，所以转成数组取第一个值
            $arr = explode(',', $res['http_x_forwarded_for']);
            $ip = $arr[0];
        }
        if ((empty($ip) or $ip == '127.0.0.1')) {
            header('x-real-ip');
            $ip = $res['remote_addr'];
        }
        return $ip;
    }
}