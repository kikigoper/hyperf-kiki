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

use App\Model\Zq;
use HPlus\Admin\Controller\AbstractAdminController;
use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController()
 */
class Index3Controller
{
    public function index()
    {
//        $user = $this->request->input('user', 'Hyperf');
//        $method = $this->request->getMethod();

//        $data = Db::table('admin_menu')->get();
        $data = Zq::query()->get();
        return [
//            'method' => $method,
            'message' => 'index3',
//            'message_full' => $this->request->fullUrl(),
            'dd' => 1,
            'hello'=>$data
        ];
    }

    public function va()
    {
//        $user = $this->request->input('user', 'Hyperf');
//        $method = $this->request->getMethod();

//        $data = Db::table('admin_menu')->get();
        $data = Zq::query()->with('zq1')->get();
        return [
//            'method' => $method,
            'message' => 'va',
//            'message_full' => $this->request->fullUrl(),
            'dd' => 1,
            'hello'=>$data
        ];
    }

    public function test2()
    {
//        $user = $this->request->input('user', 'Hyperf');
//        $method = $this->request->getMethod();

//        $data = Db::table('admin_menu')->get();
        $data = Zq::query()->with('zq1')->get();
        return [
//            'method' => $method,
            'message' => 33,
//            'message_full' => $this->request->fullUrl(),
            'dd' => 1,
            'hello'=>$data
        ];
    }
}
