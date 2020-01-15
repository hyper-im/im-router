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
use Hyperf\WebSocketClient\ClientFactory;
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
        $uri = $ip.":".$port;
        /** @var ClientFactory $factory */
        $factory = $this->container->get(ClientFactory::class);
        $this->client[$uri]  = $factory->create($uri.'/im?from=im-router',false);
//        $this->client[$uri]->setHeaders(
//            ['Sec-WebSocket-Protocol' => 'im-route']
//        );
    }


}