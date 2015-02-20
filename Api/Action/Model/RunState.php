<?php

namespace Api\Action\Model;

use MS\Automaton\Model\AbstractState;
use MS\Automaton\Model\Interfaces\ValidState;

class RunState extends AbstractState implements ValidState
{
    protected static $id = 0;
    protected static $name = 'run';
    protected static $transitions = array(
        'Api\\Action\\Model\\CollectState'
    );

    public function execute()
    {
        static::$payload->routed = true;
        $service = static::$payload->service;

        $path = explode('/', trim(static::$payload->request->getPathInfo(), '/'));
        $service_name = ucfirst(strtolower($path[0]));
        if (count($path) == 1) $action_name = 'indexAction';
        else $action_name = strtolower($path[1]) . 'Action';

        $controller_class = '\\' . $service_name . "\\Service\\" . $service_name . 'Controller';
        if (!class_exists($controller_class)) {
            static::$payload->routed = false;
        }

        $controller = new $controller_class;
        $controller->setRequest(static::$payload->request);
        $controller->setService(static::$payload->service);

        if (!method_exists($controller_class, $action_name)) {
            static::$payload->routed = false;
        }

        if (static::$payload->routed) {
            try {
                static::$payload->content = $controller->$action_name();
                $service->found();
            } catch (\Exception $e) {
                $service->failed($e);
                static::$payload->routed = false;
            }
        }
        else {
            static::$payload->content = $service->notFound(static::$payload);
        }

        $this->transition(__NAMESPACE__ . '\\CollectState');
    }

    public function entryCriteria($payload)
    {
        return isset($payload->request);
    }

    public function exitCriteria($payload)
    {
        return isset($payload->content)
        or $payload->routed == false;
    }
}
