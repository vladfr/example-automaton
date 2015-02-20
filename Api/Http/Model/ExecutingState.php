<?php

namespace Api\Http\Model;

use MS\Automaton\Model\AbstractState;
use MS\Automaton\Model\Interfaces\ValidState;

use Symfony\Component\HttpFoundation\Response;

class ExecutingState extends AbstractState implements ValidState
{
    protected static $id = 0;
    protected static $name = 'executing';
    protected static $transitions = array(
        'Api\\Http\\Model\\RespondingState',
    );

    public function execute()
    {
        static::$payload->executed = false;
        $service = static::$payload->service;

        $start_state_name = $service->getStartState();
        $start_state = new $start_state_name;
        $start_state->setPayload(static::$payload);

        $service->run($start_state);
        static::$payload->executed = true;

        $this->transition(__NAMESPACE__ . '\\RespondingState');
    }

    public function entryCriteria($payload)
    {
        return $payload->authenticated == true
        and $payload->routed == true;
    }

    public function exitCriteria($payload)
    {
        return $payload->executed == true
        and isset($payload->response)
        and $payload->response instanceof \Symfony\Component\HttpFoundation\Response;
    }
}
