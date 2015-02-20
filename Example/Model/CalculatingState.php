<?php

namespace Example\Model;

use MS\Automaton\Model\AbstractState;
use MS\Automaton\Model\Interfaces\ValidState;

class CalculatingState extends AbstractState implements ValidState
{
    protected static $id = 1;
    protected static $name = 'calculating';
    protected static $transitions = array(
        'Example\\Model\\SynchronizingState'
    );

    public function execute()
    {
        static::$payload['flags']['calculated'] = true;

        $this->transition(__NAMESPACE__ . '\\SynchronizingState');
    }

    public function entryCriteria($payload)
    {
        return !$payload['flags']['calculated'];
    }

    public function exitCriteria($payload)
    {
        return $payload['flags']['calculated'];
    }
}
