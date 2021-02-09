<?php
/**
 * Created by PhpStorm.
 * User: kai
 * Date: 2021/1/15
 */

namespace App\Manager\Redis;

use Hyperf\Redis\RedisFactory;
use Hyperf\Utils\ApplicationContext;


class Redis
{
    /**
     * 通过RedisFactory工厂类来动态的传递 poolName 来获得对应的连接池的客户端
     * @param string $poolName 连接池名称
     * @return \Hyperf\Redis\RedisProxy|\Redis
     */
    public static function defer($poolName = 'default')
    {
        $container = ApplicationContext::getContainer();

        // 通过 DI 容器获取或直接注入 RedisFactory 类
        $redis = $container->get(RedisFactory::class)->get($poolName);
        return $redis;
    }
}