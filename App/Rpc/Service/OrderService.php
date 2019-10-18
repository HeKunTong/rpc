<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19-10-14
 * Time: 上午10:29
 */

namespace App\Rpc\Service;


use EasySwoole\Rpc\AbstractService;

class OrderService extends AbstractService
{

    public function serviceName(): string
    {
        // TODO: Implement serviceName() method.
        return 'order';
    }

    public function detail() {
        $params = $this->request()->getArg();
        $this->response()->setResult(['id' => 1, 'user_id' => 2, 'data' => $params]);
    }
}