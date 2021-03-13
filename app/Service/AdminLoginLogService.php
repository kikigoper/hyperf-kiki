<?php
/**
 * Created by PhpStorm.
 * User: kai
 * Date: 2021/2/25
 */
declare(strict_types=1);

namespace App\Service;

use App\Common\Tool\Ip;
use App\Model\AdminLoginLog;
use Psr\Container\ContainerInterface;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Di\Annotation\Inject;

/**
 * 管理员登录日志
 * Class AdminLoginLogService
 * @package App\Service
 */
class AdminLoginLogService extends BaseService
{
    /**
     * @Inject
     * @var AdminLoginLog
     */
    public $adminLoginLog;

    /**
     * @Inject
     * @var Ip
     */
    public $ip;

    public function saveInfo($userId,$userName)
    {
        $data = [
            'user_id'=> $userId,
            'user_name'=> $userName,
            'ip'=> $this->ip->getClientIp()
        ];
        return $this->adminLoginLog->saveInfo($data);
    }
}