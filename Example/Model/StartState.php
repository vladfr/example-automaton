<?php

namespace Example\Model;

use MS\Automaton\Model\AbstractState;
use MS\Automaton\Model\Interfaces\ValidState;

class StartState extends AbstractState implements ValidState
{
    protected static $id = 0;
    protected static $name = 'start';
    protected static $transitions = array(
        'Example\\Model\\CalculatingState'
    );

    public function execute()
    {
        static::$payload['flags']['calculated'] = false;
        static::$payload['flags']['synchronized'] = false;

        $this->transition(__NAMESPACE__ . '\\CalculatingState');
    }

    public function entryCriteria($payload)
    {
        return $payload['flags']['calculated'] == null
        and $payload['flags']['synchronized'] == null;
    }

    public function exitCriteria($payload)
    {
        return $payload['flags']['calculated'] == false
        and $payload['flags']['synchronized'] == false;
    }
}
