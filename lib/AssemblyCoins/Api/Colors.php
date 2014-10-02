<?php

namespace AssemblyCoins\Api;

use AssemblyCoins\HttpClient\HttpClient;

/**
 * A colored coin represented on the bitcoin blockchain
 */
class Colors
{

    private $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * 
     *
     * '/colors/prepare' POST
     *
     * @param $issued_amount Starting number of coins to be issued, declared in the Blockchain
     * @param $description  Description of the Coin Color, to be written permanently in the Blockchain
     * @param $coin_name Name of the Coin Color, declared in the Blockchain
     * @param $email For use with Assembly only.  Not written in the blockchain
     */
    public function prepare($issued_amount, $description, $coin_name, $email, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['issued_amount'] = $issued_amount;
        $body['description'] = $description;
        $body['coin_name'] = $coin_name;
        $body['email'] = $email;

        $response = $this->client->post('/colors/prepare', $body, $options);

        return $response;
    }

    /**
     * 
     *
     * '/colors/:color_address' GET
     *
     * @param $color_address The unique color address string identifying the color type
     */
    public function get($color_address, array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/colors/'.rawurlencode(color_address).'', $body, $options);

        return $response;
    }

    /**
     * 
     *
     * '/colors' POST
     *
     * @param $public_address The public Bitcoin address creating new coins. This will be the source address for this color type.
     * @param $private_key The private key controlling the source address.
     * @param $name The name of the new color type, to be written on the Blockchain.
     * @param $initial_coins The number of coins to issue. More can be issued later. To be written on the Blockchain. Coins are sent back to this public address, from which they can later be transferred.
     * @param $description The description of this coin color. This is to be written on the Blockchain. It is a permanent declaration of intent.
     * @param $email The email of the coin creator. Stored by Assembly only. Not written on the Blockchain or shared with anyone.
     * @param $fee_each The Bitcoin transaction fee to pay per transaction. Note that multiple transactions are necessary to create a new coin, thus the total fee will be some multiple of this number. We suggest 0.00005 BTC.
     */
    public function create($public_address, $private_key, $name, $initial_coins, $description, $email, $fee_each, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['public_address'] = $public_address;
        $body['private_key'] = $private_key;
        $body['name'] = $name;
        $body['initial_coins'] = $initial_coins;
        $body['description'] = $description;
        $body['email'] = $email;
        $body['fee_each'] = $fee_each;

        $response = $this->client->post('/colors', $body, $options);

        return $response;
    }

}
