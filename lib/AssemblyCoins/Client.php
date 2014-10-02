<?php

namespace AssemblyCoins;

use AssemblyCoins\HttpClient\HttpClient;

class Client
{
    private $httpClient;

    public function __construct($baseUrl, $auth = array(), array $options = array())
    {
        $this->httpClient = new HttpClient($baseUrl, $auth, $options);
    }

    /**
     * A colored coin represented on the bitcoin blockchain
     */
    public function colors()
    {
        return new Api\Colors($this->httpClient);
    }

    /**
     * <no value>
     */
    public function addresses()
    {
        return new Api\Addresses($this->httpClient);
    }

    /**
     * <no value>
     */
    public function transactions()
    {
        return new Api\Transactions($this->httpClient);
    }

    /**
     * <no value>
     */
    public function messages()
    {
        return new Api\Messages($this->httpClient);
    }

}
