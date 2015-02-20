<?php

namespace Api\Http\Model;

use Symfony\Component\HttpFoundation\Request;

class Payload
{

    public $authenticated = null;
    public $routed = null;
    public $executed = null;
    public $responded = null;

    public $request = null;
    public $content = null;

    public function __construct() {
        $this->request = Request::createFromGlobals();
    }

}