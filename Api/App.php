<?php

namespace Api;

use ArrayObject;
use Api\Http\Model\Payload as HttpPayload;
use Api\Http\Model\StartState;
use Api\Http\Service\Process;

class App
{
    public function run()
    {
        /**
         * Preparing payload
         */
        $httpPayload = new HttpPayload();

        /**
         * Preparing initial state
         */
        $state = new StartState();
        $state->setPayload($httpPayload);

        /**
         * Running process.
         */
        $process = new Process();
        ob_start();
        $process->run($state);
    }
}
