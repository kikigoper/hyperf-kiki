<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\Manager\HttpClient\GuzzleHttp;
use Hyperf\HttpServer\Annotation\AutoController;
use \App\Model\User;
use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Cache\Annotation\CacheEvict;
use Hyperf\Cache\Annotation\CachePut;

/**
 * @AutoController()
 */
class IndexController extends AbstractController
{
    //缓存(增加)
    /**
     * @Cacheable(prefix="user", ttl=7200, listener="USER_CACHE")
     */
    public function search()
    {
        $user = User::query()->where('id',2)->first();

        return [
            'user' => $user->toArray(),
        ];
    }

    //缓存(删)
    /**
     * @CacheEvict(prefix="user")
     */
//    public function index()
//    {
////        $user = User::query()->where('id',2)->first();
//
//        return true;
////        return [
////            'user' => $user->toArray(),
////        ];
//    }

    /**
     * @CachePut(prefix="user", ttl=3601)
     */
    public function update()
    {
        $user = User::query()->where('id',2)->first();
        $user->name = 'HyperfDoc';
        $user->save();

        return [
            'user' => $user->toArray(),
        ];
    }
//    public function index():array
//    {
////        $user = $this->request->input('foo', 'Hyperf');
////        echo $user;
////        $method = $this->request->getMethod();
////        $model  = new GuzzleHttp();
////        $data = $model->getJson('http://127.0.0.1:9701/index2/index',['foo' => 'get数据']);
////        $user = $this->request->input('foo', 'Hyperf');
////        echo $user;
////        $method = $this->request->getMethod();
////        $model  = new GuzzleHttp();
////        http://127.0.0.1:9701/index2/index
//        $data = 35;
//
//        return [
////            'method' => $method,
////            'message' => "Hello {$user}.",
//            'data' => $data,
//        ];
//    }

}
