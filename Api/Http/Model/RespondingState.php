<?php

namespace Api\Http\Model;

use MS\Automaton\Model\AbstractState;
use MS\Automaton\Model\Interfaces\ValidState;

class RespondingState extends AbstractState implements ValidState
{
    protected static $id = 0;
    protected static $name = 'responding';
    protected static $transitions = array(
        'Api\\Http\\Model\\StopState',
    );

    public function execute()
    {
        static::$payload->responded = false;

        $request = static::$payload->request;
        $response = static::$payload->response;
        $response->prepare($request)->send();

        static::$payload->responded = true;
        $this->transition(__NAMESPACE__ . '\\StopState');
    }

    public function entryCriteria($payload)
    {
        return isset($payload->response)
        and ($payload->response instanceof \Symfony\Component\HttpFoundation\Response);
    }

    public function exitCriteria($payload)
    {
        return $payload->responded == true;
    }
}
