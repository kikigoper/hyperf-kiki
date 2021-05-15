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
     *created_at和updated_at 由系统自动维护，无需添加
     * @param string $enKey 英文索引
     * @param string $cnKey 中文索引
     * @param string $content 日志内容
     * @return \App\Model\BaseModel|array|\Hyperf\Database\Model\Model
     */
    public function debug($content = '',$enKey = 'index', $cnKey = 'cn_index')
    {
        $data = [
            'en_key' => $enKey,
            'cn_key' => $cnKey,
            'content' => $content,
        ];
        return $this->mainLog->log($data);
    }
}