<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19-10-14
 * Time: 上午10:30
 */

namespace App\Rpc\Service;


use EasySwoole\Rpc\AbstractService;

class NodeService extends AbstractService
{

    public function serviceName(): string
    {
        // TODO: Implement serviceName() method.
        return 'node';
    }
}