<?php

declare(strict_types=1);
/**
 * 入口模块
 */

namespace App\Controller\Admin;

use App\Service\AdminLoginLogService;
use HPlus\Admin\Exception\ValidateException;
use HPlus\Admin\Facades\Admin;
use HPlus\Admin\Model\Admin\Administrator;
use HPlus\Route\Annotation\ApiController;
use HPlus\Route\Annotation\GetApi;
use HPlus\Route\Annotation\PostApi;
use HPlus\UI\Components\Antv\Area;
use HPlus\UI\Components\Antv\Column;
use HPlus\UI\Components\Antv\Funnel;
use HPlus\UI\Components\Antv\Line;
use HPlus\UI\Components\Antv\Pie;
use HPlus\UI\Components\Antv\StepLine;
use HPlus\UI\Components\Widgets\Alert;
use HPlus\UI\Components\Widgets\Button;
use HPlus\UI\Components\Widgets\Card;
use HPlus\UI\Entity\MenuEntity;
use HPlus\UI\Entity\UISettingEntity;
use HPlus\UI\Entity\UserEntity;
use HPlus\UI\Layout\Content;
use HPlus\UI\Layout\Row;
use HPlus\UI\UI;
use Hyperf\Contract\ContainerInterface;
use Hyperf\HttpMessage\Cookie\Cookie;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Utils\Arr;
use Qbhy\HyperfAuth\AuthManager;
use Hyperf\Di\Annotation\Inject;

/**
 * @ApiController(prefix="auth", tag="入口文件")
 */
class AuthController
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var AuthManager
     */
    protected $auth;

    /**
     * @Inject
     * @var AdminLoginLogService
     */
    public $adminLoginLogService;

    public function __construct(AuthManager $auth, ContainerInterface $container, RequestInterface $request, ResponseInterface $response)
    {
        $this->response = $response;
        $this->request = $request;
        $this->auth = $auth->guard(config('admin.auth.guard', 'jwt'));
    }

    /**
     * @GetApi(path="_self_path")
     * @return array|mixed
     */
    public function index()
    {
        $token = $this->request->cookie($this->getCookieName());
        $userInfo = new UserEntity();
        $setting = new UISettingEntity(config('admin'));
        try {
            $user = Admin::user($token);
            $userInfo->setUsername($user->username);
            $userInfo->setName($user->name);
            $userInfo->setId($user->getId());
            $userInfo->setAvatar($user->avatar);
            $userInfo->setToken($token);
            $menuTree = Admin::menu($user);
            $setting->setMenu(new MenuEntity($menuTree));
        } catch (\Throwable $exception) {
            p("登录失败，" . $exception->getMessage());
        }
        $setting->setUser($userInfo);
        $setting->setUrl([
            'logout' => route('/auth/logout'),
            'setting' => route('/auth/setting'),
        ]);
        $setting->setApiRoot(config('admin.route.api_prefix'));
        $setting->setHomeUrl(config('admin.route.home'));
        return UI::view($setting);
    }

    /**
     * @GetApi
     */
    public function main()
    {
        $content = new Content();
        $content->className('m-10')
            ->row(function (Row $row) {
                $row->gutter(10);
                $row->className('mt-10');
                $row->column(12, Alert::make('你好，同学！！', '欢迎使用 Element kiki')->showIcon()->closable(false)->type('success'));
                //$row->column(12, Alert::make('你好，同学！！', '欢迎使用 hyperf-plus-admin')->showIcon()->closable(false)->type('error'));
                //$row->column(12, Alert::make('你好，同学！！', '欢迎使用 hyperf-plus-admin')->showIcon()->closable(false)->type('warning'));
                //$row->column(12, Alert::make('你好，同学！！', '欢迎使用 hyperf-plus-admin')->showIcon()->closable(false)->type('info'));
            });
        return $content;
    }

    /**
     * @PostApi
     */
    public function login()
    {
        $data = $this->request->all();
        # 验证器暂无实现，等后期实现后在对此进行改造
        if (!isset($data['username']) || $data['username'] == '') {
            throw new ValidateException(400, '用户名不能为空');
        }
        if (!isset($data['password']) || $data['password'] == '') {
            throw new ValidateException(400, '密码不能为空');
        }
        $user = Administrator::query()->where('username', $data['username'])->first();
        if (empty($user) || !password_verify($data['password'], $user->password)) {
            throw new ValidateException(400, '用户名或密码不正确');
        }
        $token = $this->auth->login($user);
        $this->adminLoginLogService->saveInfo($user->id, $user->username); // 登录日志记录
        $data = [];
        $data['message'] = '登录成功';
        $data['status'] = 200;
        $data['redirect'] = route('/auth');
        return $this->response->withCookie($this->getCookie($token))->json($data);
    }

    /**
     * @GetApi
     */
    public function logout()
    {
        $this->auth->logout();
        $redirect = route('/auth');
        return $this->response->withCookie($this->getCookie(''))->redirect($redirect);
    }

    private function getCookie($token)
    {
        $secure = $this->request->getUri()->getScheme() == 'https';
        return new Cookie($this->getCookieName(), $token, 0, '/', $this->request->getUri()->getHost(), $secure, $secure);
    }

    protected function getCookieName()
    {
        return 'HPLUSSESSIONID';
        //        return 'gfdyk';
    }
}
