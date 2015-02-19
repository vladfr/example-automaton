<?php

namespace Example\Service;

use MS\Automaton\Service\Process as AbstractProcess;

class Process extends AbstractProcess
{
    protected static $exitState = 'Example\\Model\\StopState';
}
