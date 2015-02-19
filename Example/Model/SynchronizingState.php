<?php

namespace Example\Model;

use MS\Automaton\Model\AbstractState;
use MS\Automaton\Model\Interfaces\ValidState;

class SynchronizingState extends AbstractState implements ValidState
{
    protected static $id = 1;
    protected static $name = 'synchronizing';
    protected static $transitions = array(
        'Example\\Model\\StopState'
    );

    public function execute()
    {
        static::$payload['flags']['synchronized'] = true;

        $this->transition(__NAMESPACE__ . '\\StopState');
    }

    public function entryCriteria($payload)
    {
        return !$payload['flags']['synchronized'];
    }

    public function exitCriteria($payload)
    {
        return $payload['flags']['synchronized'];
    }
}
