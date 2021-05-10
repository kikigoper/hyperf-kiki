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

class IndexController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
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
}