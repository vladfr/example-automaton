<?php

namespace MS\Automaton\Service;

use MS\Automaton\Model\Interfaces\ValidState;
use MS\Automaton\Model\Interfaces\InvalidState;

abstract class Process
{
    protected static $exitState;

    public function run(ValidState $state)
    {
        try {
            while (true) {
                try {
                    echo $state->getName() . ': ' . $state->getDescription() . "<br/>\n";

                    $state->execute();
                } catch (ValidState $state) {
                    if (get_class($state) === static::$exitState OR is_subclass_of($state, static::$exitState)) {
                        break;
                    }
                }
            }
        } catch (InvalidState $e) {
            echo $state->getName() . ': ' . $state->getDescription() . "<br/>\n";

            return;
        }
    }
}
