<?php
/**
 * Created by PhpStorm.
 * User: Qi
 * Date: 2021/5/10
 */
use Hyperf\Crontab\Crontab;
return [
    // 是否开启定时任务
    'enable' => false,
//    'enable' => true,
    // 通过配置文件定义的定时任务
    'crontab' => [
        // Callback类型定时任务（默认）
        (new Crontab())->setName('Foo')->setRule('* * * * *')->setCallback([App\Console\FooTask::class, 'execute'])->setMemo('这是一个示例的定时任务'),
        // Command类型定时任务
//        (new Crontab())->setType('command')->setName('Bar')->setRule('* * * * *')->setCallback([
//            'command' => 'swiftmailer:spool:send',
//            // (optional) arguments
//            'fooArgument' => 'barValue',
//            // (optional) options
//            '--message-limit' => 1,
//        ]),
    ],
];