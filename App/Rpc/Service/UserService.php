<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19-10-14
 * Time: 上午10:29
 */

namespace App\Rpc\Service;


use EasySwoole\Rpc\AbstractService;

class UserService extends AbstractService
{

    public function serviceName(): string
    {
        // TODO: Implement serviceName() method.
        return 'user';
    }

    public function register() {
        $this->response()->setResult('register');
    }
}