<?php

namespace Api\Action\Service;

use MS\Automaton\Service\Process as AbstractProcess;
use MS\Automaton\Model\Interfaces\ValidState;

use Symfony\Component\HttpFoundation\Response;

class ActionProcess extends AbstractProcess
{
    protected $startState = '\\Api\\Action\\Model\\RunState';

    public function getStartState()
    {
        return $this->startState;
    }

    protected $exitState = 'Api\\Action\\Model\\CollectState';

    protected $_statusCode = null;

    public function setStatusCode($code) {
        $this->_statusCode = $code;
    }

    public function getStatusCode() {
        return $this->_statusCode;
    }

    public function found() {
        $this->setStatusCode(Response::HTTP_OK);
    }

    public function notFound($payload) {
        $this->setStatusCode(Response::HTTP_NOT_FOUND);
    }

    public function failed($e) {
        $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

