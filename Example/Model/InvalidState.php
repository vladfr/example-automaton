<?php

namespace Example\Model;

use MS\Automaton\Model\AbstractState;
use MS\Automaton\Model\Interfaces\InvalidState as InvalidStateInterface;

class InvalidState extends AbstractState implements InvalidStateInterface
{
    protected static $id = 99;
    protected static $name = 'InvalidState';
} 