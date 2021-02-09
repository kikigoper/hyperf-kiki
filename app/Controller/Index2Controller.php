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
class Index2Controller extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('foo', 'Hyperf');
        echo $user;
        return [
            'index2get数据' => $user,
        ];
    }
}
