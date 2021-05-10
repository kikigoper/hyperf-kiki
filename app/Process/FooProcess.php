<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Qi
 * Date: 2021/5/10
 */
namespace App\Process;

use Hyperf\Process\AbstractProcess;
use phpDocumentor\Reflection\Types\True_;

class FooProcess extends AbstractProcess
{
    public function handle(): void
    {
        // 您的代码 ...
        while (true) {
           echo 666;
            sleep(1);
        }
    }

    public function isEnable($server): bool
    {
        // 不跟随服务启动一同启动
        return false;
    }

    /**
     * 进程数量
     * @var int
     */
    public $nums = 1;

    /**
     * 进程名称
     * @var string
     */
    public $name = 'user-process';

    /**
     * 重定向自定义进程的标准输入和输出
     * @var bool
     */
    public $redirectStdinStdout = false;

    /**
     * 管道类型
     * @var int
     */
    public $pipeType = 2;

    /**
     * 是否启用协程
     * @var bool
     */
    public $enableCoroutine = true;
}