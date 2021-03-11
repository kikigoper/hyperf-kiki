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
        if(isset($res['http_client_ip'])){
            return $res['http_client_ip'];
        }elseif(isset($res['http_x_real_ip'])){
            return $res['http_x_real_ip'];
        }elseif(isset($res['http_x_forwarded_for'])){
            //部分CDN会获取多层代理IP，所以转成数组取第一个值
            $arr = explode(',',$res['http_x_forwarded_for']);
            return $arr[0];
        }else{
            return $res['remote_addr'];
        }
    }
}