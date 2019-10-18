<?php


namespace App\HttpController;


use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Rpc\Config;
use EasySwoole\Rpc\Rpc;
use EasySwoole\Rpc\NodeManager\RedisManager;
use EasySwoole\Rpc\Response;
use EasySwoole\Rpc\ServiceCall;
use EasySwoole\Component\Csp;

class Index extends Controller
{

    function index()
    {
        $file = EASYSWOOLE_ROOT . '/vendor/easyswoole/easyswoole/src/Resource/Http/welcome.html';
        if (!is_file($file)) {
            $file = EASYSWOOLE_ROOT . '/src/Resource/Http/welcome.html';
        }
        $this->response()->write(file_get_contents($file));
    }

    protected function actionNotFound(?string $action)
    {
        $this->response()->withStatus(404);
        $file = EASYSWOOLE_ROOT . '/vendor/easyswoole/easyswoole/src/Resource/Http/404.html';
        if (!is_file($file)) {
            $file = EASYSWOOLE_ROOT . '/src/Resource/Http/404.html';
        }
        $this->response()->write(file_get_contents($file));
    }

    public function test()
    {


        $config = new Config();
        $nodeManager = new RedisManager('192.168.2.122'); //按自己配置
        $config->setNodeManager($nodeManager);
        $rpc = new Rpc($config);

        $client = $rpc->client();

        $csp = new Csp();

        $client->addCall('user', 'register', ['arg1', 'arg2'])
            ->setOnFail(function (Response $response, ServiceCall $call) {})
            ->setOnSuccess(function (Response $response, ServiceCall $call) use ($csp) {
                $csp->add('t1', function () use ($response) {
                    return $response->toArray();
            });
        });

        $client->addCall('order', 'detail', [mt_rand(1, 5)])
            ->setOnFail(function (Response $response, ServiceCall $call) {})
            ->setOnSuccess(function (Response $response, ServiceCall $call) use ($csp) {
                $csp->add('t2', function () use ($response) {
                    return $response->toArray();
            });
        });


        $client->exec();
        $data = $csp->exec();

        $d = var_export($data, true);
        $this->response()->write("<pre>{$d}</pre>");

    }
}