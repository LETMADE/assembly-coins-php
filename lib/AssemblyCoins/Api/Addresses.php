<?php

namespace AssemblyCoins\Api;

use AssemblyCoins\HttpClient\HttpClient;

/**
 * <no value>
 */
class Addresses
{

    private $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * 
     *
     * '/addresses/:public_address' GET
     *
     * @param $public_address The public Bitcoin address whose colored assets balance you wish to check.
     */
    public function balances($public_address, array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/addresses/'.rawurlencode(public_address).'', $body, $options);

        return $response;
    }

    /**
     * 
     *
     * '/addresses' GET
     */
    public function generate(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/addresses', $body, $options);

        return $response;
    }

    /**
     * 
     *
     * '/addresses/brainwallet/:your_phrase' GET
     *
     * @param $your_phrase A passphrase that deterministically maps to a Bitcoin public/private keypair.
     */
    public function generateBrainwallet($your_phrase, array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/addresses/brainwallet/'.rawurlencode(your_phrase).'', $body, $options);

        return $response;
    }

}
