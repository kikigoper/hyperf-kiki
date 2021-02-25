<?php
/**
 * Created by PhpStorm.
 * User: kai
 * Date: 2021/2/25
 */
declare(strict_types=1);

namespace App\Service;

use Psr\Container\ContainerInterface;
use Hyperf\Logger\LoggerFactory;

class DemoService
{

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    public function __construct(LoggerFactory $loggerFactory)
    {
        // 第一个参数对应日志的 name, 第二个参数对应 config/autoload/logger.php 内的 key
        $this->logger = $loggerFactory->get('log', 'default');
    }

    public function method()
    {
        // Do somthing.
        $this->logger->info("Your log message.");
    }
}