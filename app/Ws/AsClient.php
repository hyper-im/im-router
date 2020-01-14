<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2020 https://github.com/hyper-im All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2020/1/14 5:33 PM
 * | Author: Quinn (798908243@qq.com) QQ：798908243
 * +----------------------------------------------------------------------
 */

namespace App\Ws;


use Hyperf\Contract\StdoutLoggerInterface;
use Psr\Container\ContainerInterface;
use Swoole\Coroutine\Http\Client;

class AsClient
{

    private $client = [];
    protected $logger = null;
    protected $container = null;

    public function __construct(StdoutLoggerInterface $stdoutLogger, ContainerInterface $container)
    {
        $this->logger = $stdoutLogger;
        $this->container = $container;
    }

    public function getInstance($ip,$port){
        $key = $ip.":".$port;
        if(!isset($this->client[$key]) || $this->client[$key] == null){
            $this->initClient($ip,$port);
        }
        return $this;
    }

    private function initClient($ip,$port)
    {
        $this->logger->debug("正在实例化Client[SERVER=".$ip.":".$port."]......");
        go(function() use ($ip,$port){
            $cli = new Client($ip, $port);
            $ret = $cli->upgrade("/im");
            if ($ret) {
                $key = $ip.":".$port;
                $this->client[$key] = $cli;
                //心跳处理
                swoole_timer_tick(3000,function ()use($cli){
                    if($cli->errCode==0){
                        $cli->push('',WEBSOCKET_OPCODE_PING);
                    }
                });
            }
            else
            {
                $this->logger->error("无法与Server[".$ip.":".$port."]建立连接");
            }
        });

    }


}