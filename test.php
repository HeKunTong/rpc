<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19-10-14
 * Time: 上午10:34
 */

require_once 'vendor/autoload.php';

use EasySwoole\Rpc\Config;
use EasySwoole\Rpc\Rpc;
use EasySwoole\Rpc\NodeManager\RedisManager;
use EasySwoole\Rpc\Response;
use EasySwoole\Rpc\ServiceCall;

//cli模拟，跨进程，重新new rpc对象
$config = new Config();
$nodeManager = new RedisManager('127.0.0.1');
$config->setNodeManager($nodeManager);
$rpc = new Rpc($config);

go(function () use ($rpc) {
    $client = $rpc->client();

    $client->addCall('user', 'register', ['arg1', 'arg2'])
        ->setOnFail(function (Response $response, ServiceCall $call) {
            var_dump($response->toArray());
             var_dump($call);
        })
        ->setOnSuccess(function (Response $response, ServiceCall $call) {
            var_dump($response->toArray());
//            var_dump($call);
        });

    $client->exec();


});
