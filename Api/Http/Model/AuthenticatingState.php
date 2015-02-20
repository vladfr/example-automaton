<?php

namespace Api\Http\Model;

use Symfony\Component\HttpFoundation\Session\Session;

use MS\Automaton\Model\AbstractState;
use MS\Automaton\Model\Interfaces\ValidState;

class AuthenticatingState extends AbstractState implements ValidState
{
    protected static $id = 0;
    protected static $name = 'authenticating';
    protected static $transitions = array(
        'Api\\Http\\Model\\RoutingState',
    );

    public function execute()
    {
        static::$payload->authenticated = false;
        $request = static::$payload->request;

        if (!empty($request->query->get('user'))) {
            if ($request->hasPreviousSession()) {
                $authenticated = $this->_checkSession($request->getSession());
            }
            else {
                $authenticated = $this->_newSession($request);
            }

            if ($authenticated) {
                static::$payload->authenticated = $request->getSession()->start();
            }
        }

        $this->transition(__NAMESPACE__ . '\\RoutingState');
    }

    public function entryCriteria($payload)
    {
        return $payload->authenticated == null;
    }

    public function exitCriteria($payload)
    {
        return $payload->authenticated == true;
    }

    protected function _newSession($request) {
        $session = new Session();
        $request->setSession($session);
        return $request->hasSession();
    }

    protected function _checkSession($session) {
        return true;
    }
}
