<?php
/**
 * Created by PhpStorm.
 * User: Qi
 * Date: 2021/3/11
 */

namespace App\Common\Tool;

use App\Model\MainLog;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;

class Log
{
    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     * @var MainLog
     */
    protected $mainLog;

    /**
     * created_at和updated_at 由系统自动维护，无需添加
     * @param $data
     * @return \App\Model\BaseModel|array|\Hyperf\Database\Model\Model
     * $data = [
     * 'en_key' => 'zq1',
     * 'cn_key' => '钟琪',
     * 'content' => '主要内容',
     * ];
     */
    public function debug($data)
    {
        return $this->mainLog->log($data);
    }
}