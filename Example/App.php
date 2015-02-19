<?php

namespace Example;

use ArrayObject;

use Example\Model\StartState;
use Example\Service\Process;

class App
{
    public function run()
    {
        /**
         * Preparing payload
         */
        $payload = new ArrayObject(
            array(
                'data' => array(),
                'flags' => array(
                    'calculated' => null,
                    'synchronized' => null,
                ),
            )
        );

        /**
         * Preparing initial state
         */
        $state = new StartState();
        $state->setPayload($payload);

        /**
         * Running process.
         */
        $process = new Process();
        $process->run($state);
    }
}
