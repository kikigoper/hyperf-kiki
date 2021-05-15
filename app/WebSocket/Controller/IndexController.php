<?php
declare(strict_types=1);

namespace App\WebSocket\Controller;
/**
 * Created by PhpStorm.
 * User: Qi
 * Date: 2021/5/10
 */

use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Swoole\Http\Request;
use Swoole\Server;
use Swoole\Websocket\Frame;
use Swoole\WebSocket\Server as WebSocketServer;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Layout\Content;
use HPlus\UI\Layout\Row;
use HPlus\UI\Components\Widgets\Alert;
use HPlus\Route\Annotation\GetApi;
use HPlus\Route\Annotation\PostApi;

/**
 * @AdminController(prefix="/ws-index", tag="", ignore=true))
 */
class IndexController extends AbstractAdminController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
    /**
     * 消息返回
     * @param \Swoole\Http\Response|WebSocketServer $server
     * @param Frame $frame
     */
    public function onMessage($server, Frame $frame): void
    {
        $server->push($frame->fd, 'Recv: ' . $frame->data); //push用于返回消息
    }

    /**
     * 关闭连接
     * @param \Swoole\Http\Response|Server $server
     * @param int $fd
     * @param int $reactorId
     */
    public function onClose($server, int $fd, int $reactorId): void
    {
        var_dump('closed');
    }

    /**
     * 打开连接
     * @param \Swoole\Http\Response|WebSocketServer $server
     * @param Request $request
     */
    public function onOpen($server, Request $request): void
    {
        $server->push($request->fd, 'Opened');
    }

    /**
     * @GetApi
     */
    public function index()
    {
        $content = new Content();
        $content->className('m-10')
            ->row(function (Row $row) {
                $row->gutter(10);
                $row->className('mt-10');
                $row->column(12, Alert::make('通讯工具开发中，敬请期待...')->showIcon()->closable(false)->type('success'));
            });
        return $content;
    }
}