<?php

namespace Api\Action\Service;

class ActionController
{

    public function setRequest($request) {
        $this->request = $request;
    }

    public function setService($service) {
        $this->service = $service;
    }

}