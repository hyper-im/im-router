<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2020 https://github.com/hyper-im All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2020/1/14 3:09 PM
 * | Author: Quinn (798908243@qq.com) QQ：798908243
 * +----------------------------------------------------------------------
 */

namespace App\Ws;


use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Swoole\Http\Request;
use Swoole\Websocket\Frame;
use Swoole\WebSocket\Server;

class ServerController  implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{

    public function onOpen(Server $server, Request $request): void
    {
        // TODO: Implement onOpen() method.
    }

    public function onMessage(Server $server, Frame $frame): void
    {
        // TODO: Implement onMessage() method.
    }

    public function onClose(\Swoole\Server $server, int $fd, int $reactorId): void
    {
        // TODO: Implement onClose() method.
    }


}