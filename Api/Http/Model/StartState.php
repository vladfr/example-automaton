<?php

namespace Api\Http\Model;

use MS\Automaton\Model\AbstractState;
use MS\Automaton\Model\Interfaces\ValidState;

class StartState extends AbstractState implements ValidState
{
    protected static $id = 0;
    protected static $name = 'start';
    protected static $transitions = array(
        __NAMESPACE__ . '\\AuthenticatingState'
    );

    public function execute()
    {
        static::$payload->authenticated = false;

        $this->transition(__NAMESPACE__ . '\\AuthenticatingState');
    }

    public function exitCriteria($payload)
    {
        return static::$payload->authenticated == false;
    }
}
