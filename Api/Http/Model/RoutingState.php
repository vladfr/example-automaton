<?php

namespace Api\Http\Model;

use MS\Automaton\Model\AbstractState;
use MS\Automaton\Model\Interfaces\ValidState;

class RoutingState extends AbstractState implements ValidState
{
    protected static $id = 0;
    protected static $name = 'routing';
    protected static $transitions = array(
        'Api\\Http\\Model\\ExecutingState',
        'Api\\Http\\Model\\NotFoundState',
    );

    public function execute()
    {
        $path = explode('/', trim(static::$payload->request->getPathInfo(), '/'));
        $service_name = ucfirst(strtolower($path[0]));
        $class_name = '\\' . $service_name . "\\Service\\Http";

        if (class_exists($class_name)) {
            static::$payload->service = new $class_name;
            static::$payload->service_name = $service_name;
            static::$payload->routed = true;
            $this->transition(__NAMESPACE__ . '\\ExecutingState');
        }

        if (!static::$payload->routed) {
            $this->transition(__NAMESPACE__ . '\\NotFoundState');
        }
    }

    public function entryCriteria($payload)
    {
        return $payload->routed == null
        and $payload->authenticated == true
        and !empty($payload->request->getPathInfo());
    }

}
