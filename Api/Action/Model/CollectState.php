<?php

namespace Api\Action\Model;

use MS\Automaton\Model\AbstractState;
use MS\Automaton\Model\Interfaces\ValidState;

use Symfony\Component\HttpFoundation\Response;

class CollectState extends AbstractState implements ValidState
{
    protected static $id = 0;
    protected static $name = 'collect';

    public function execute()
    {
        static::$payload->response = new Response(
            static::$payload->content,
            static::$payload->service->getStatusCode(),
            array('content-type' => 'text/html')
        );
    }
}