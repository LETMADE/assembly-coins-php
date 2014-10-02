<?php

namespace AssemblyCoins\HttpClient;

use Guzzle\Common\Event;

/**
 * AuthHandler takes care of devising the auth type and using it
 */
class AuthHandler
{
    private $auth;

    public function __construct(array $auth = array())
    {
        $this->auth = $auth;
    }

    /**
     * Calculating the Authentication Type
     */
    public function getAuthType()
    {

        return -1;
    }

    public function onRequestBeforeSend(Event $event)
    {
        if (empty($this->auth)) {
            return;
        }

        $auth = $this->getAuthType();
        $flag = false;

        if (!$flag) {
            throw new \ErrorException('Unable to calculate authorization method. Please check.');
        }
    }

}
