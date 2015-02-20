<?php

namespace MS\Automaton\Service;

use MS\Automaton\Model\Interfaces\ValidState;
use MS\Automaton\Model\Interfaces\InvalidState;

abstract class Process
{
    protected $exitState;

    public function getExitState()
    {
        return $this->exitState;
    }

    public function run(ValidState $state)
    {
        try {
            $i=0; $currentState = null;
            while ($i <= 10) {
                try {
                    if (get_class($state) === $currentState) {
                        $i++;
                    }
                    echo get_class($state) . ': ' . $state->getDescription() . "<br/>\n";
                    $currentState = get_class($state);
                    $state->execute();
                } catch (ValidState $state) {
                    if (get_class($state) === $this->exitState OR is_subclass_of($state, $this->exitState)) {
                        echo get_class($state) . "<br/>\n";
                        $state->execute();
                        break;
                    }
                }
            }
        } catch (InvalidState $e) {
            echo $e->getName() . ': ' . $state->getDescription() . "<br/>\n";

            return;
        }
    }
}
