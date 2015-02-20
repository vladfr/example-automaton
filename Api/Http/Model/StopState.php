<?php

namespace Api\Http\Model;

use MS\Automaton\Model\AbstractState;
use MS\Automaton\Model\Interfaces\ValidState;

class StopState extends AbstractState implements ValidState
{
    protected static $id = 0;
    protected static $name = 'stop';

    public function execute()
    {
    }

}