<?php

namespace Api\Http\Model;

use MS\Automaton\Model\AbstractState;
use MS\Automaton\Model\Interfaces\ValidState;
use Symfony\Component\HttpFoundation\Response;

class NotFoundState extends AbstractState implements ValidState
{
    protected static $id = 0;
    protected static $name = 'notfound';
    protected static $transitions = array(
        'Api\\Http\\Model\\RespondingState',
    );

    public function execute()
    {
        $response = new Response('404 Not Found');
        $response->setStatusCode(Response::HTTP_NOT_FOUND);

        static::$payload->response = $response;
        static::$payload->responded = true;

        $this->transition(__NAMESPACE__ . '\\RespondingState');
    }

    public function entryCriteria($payload)
    {
        return $payload->routed == false
        and $payload->authenticated == true;
    }

    public function exitCriteria($payload)
    {
        return $payload->responded == true
        && isset($payload->response);
    }
}
