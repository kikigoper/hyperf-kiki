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

use App\Common\Tool\Ip;
use App\Manager\HttpClient\GuzzleHttp;
use App\Model\Zq;
use App\Service\DemoService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use \App\Model\User;
use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Cache\Annotation\CacheEvict;
use Hyperf\Cache\Annotation\CachePut;
use App\Request\FooRequest;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

/**
 * @AutoController()
 */
class IndexController extends AbstractController
{
    /**
     * @Inject
     * @var DemoService
     */
    public $demoService;

    /**
     * @Inject()
     * @var ValidatorFactoryInterface
     */
    protected $validationFactory;


    public function index()
    {
//        $user = Zq::query()->get();
//        return $user;
//        return (new Ip())->getClientIp();
        return Zq::listInfo('id',[1,2]);
    }

    /**
     * 模型es
     */
//    public function index()
//    {
//        try {
////            $order = new Zq();
//            $order = Zq::find(13);
////            $order->id  = 13;
////            $order->user_id  = 1;
////            $order->created_at  = 1;
////            $order->updated_at  = 1;
////            $order->phone  = 1;
////            $order->name  = '钟琪3';
////            $order->save();
//            $order->delete();
//        } catch (\Throwable $e) {
//           return $e->getMessage();
//        }
//
//    }
    //模型缓存
//    public function index()
//    {
//        $model = Zq::findFromCache(2);
//        return $model;
////        Zq::query(true)->where('id', 1)->delete();
//    }


    //关联
//    public function index()
//    {
//        $user = Zq::query()->with('user')->get();;
//        return $user;
//    }

//    public function index(FooRequest $request)
//    {
//        $validated = $request->validated();
//        return $validated;
//    }


    // 验证器
//    public function index()
//    {
//        try {
//           throw new \Exception('hahh',666);
//        } catch (\Throwable $e) {
//           return ['a'=>$e->getMessage()];
//        }
//        $post = [
//            'foo' => 66,
//            'bar' => ''
//        ];
//        $validator = $this->validationFactory->make(
//            $post,
//            [
//                'foo' => 'required|min:15',
//                'bar' => 'required',
//            ],
//            [
//                'foo.required' => 'foo is required',
//                'foo.max' => '最小15',
//                'bar.required' => 'bar is required',
//            ]
//        );
//
//        if ($validator->fails()){
//            // Handle exception
//            $errorMessage = $validator->errors()->first();
//            return $errorMessage;
//        }
//    }

    //缓存(增加)
    /**
     * @Cacheable(prefix="user", ttl=7200, listener="USER_CACHE")
     */
    public function search()
    {
        $user = User::query()->where('id', 2)->first();

        return [
            'user' => $user->toArray(),
        ];
    }

    //国际化
//    public function index()
//    {
////        $this->demoService->method();
//        return trans('messages.welcome');
//    }

    /**
     * @CachePut(prefix="user", ttl=3601)
     */
    public function update()
    {
        $user = User::query()->where('id', 2)->first();
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
