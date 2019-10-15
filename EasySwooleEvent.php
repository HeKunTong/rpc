<?php
namespace EasySwoole\EasySwoole;


use App\Rpc\Service\NodeService;
use App\Rpc\Service\OrderService;
use App\Rpc\Service\UserService;
use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\Rpc\NodeManager\RedisManager;
use EasySwoole\Rpc\Rpc;

class EasySwooleEvent implements Event
{

    public static function initialize()
    {
        // TODO: Implement initialize() method.
        date_default_timezone_set('Asia/Shanghai');
    }

    public static function mainServerCreate(EventRegister $register)
    {
        // TODO: Implement mainServerCreate() method.

        #####################  rpc 服务1 #######################
        $config = new \EasySwoole\Rpc\Config();
        $config->setServerIp('127.0.0.1');//注册提供rpc服务的ip
        $config->setNodeManager(new RedisManager('127.0.0.1'));//注册节点管理器
        $config->getBroadcastConfig()->setSecretKey('lucky');        //设置秘钥

        $rpc = Rpc::getInstance($config);
        $rpc->add(new UserService());  //注册服务
        $rpc->add(new OrderService());
        $rpc->add(new NodeService());

        $rpc->attachToServer(ServerManager::getInstance()->getSwooleServer());

    }

    public static function onRequest(Request $request, Response $response): bool
    {
        // TODO: Implement onRequest() method.
        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}