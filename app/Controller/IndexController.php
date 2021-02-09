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

/**
 * @AutoController()
 */
class IndexController extends AbstractController
{
    public function index()
    {
//        $user = $this->request->input('foo', 'Hyperf');
//        echo $user;
//        $method = $this->request->getMethod();
//        $model  = new GuzzleHttp();
//        $data = $model->getJson('http://127.0.0.1:9701/index2/index',['foo' => 'get数据']);
//        $user = $this->request->input('foo', 'Hyperf');
//        echo $user;
//        $method = $this->request->getMethod();
//        $model  = new GuzzleHttp();
//        http://127.0.0.1:9701/index2/index
        $data = 1;

        return [
//            'method' => $method,
//            'message' => "Hello {$user}.",
            'data' => $data,
        ];
    }
}
