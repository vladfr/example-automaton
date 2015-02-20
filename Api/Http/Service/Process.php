<?php

namespace Api\Http\Service;

use MS\Automaton\Service\Process as AbstractProcess;

class Process extends AbstractProcess
{
    protected $exitState = 'Api\\Http\\Model\\StopState';
}
