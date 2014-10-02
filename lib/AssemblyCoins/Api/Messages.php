<?php

namespace AssemblyCoins\Api;

use AssemblyCoins\HttpClient\HttpClient;

/**
 * <no value>
 */
class Messages
{

    private $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * 
     *
     * '/messages' POST
     *
     * @param $public_address Public Bitcoin address sending message.
     * @param $fee_each Bitcoin transaction fee to spend per transaction. Depending on the length of the message, there may be multiple transactions.
     * @param $private_key The private key of the Bitcoin address writing the message.
     * @param $message The message itself to be written in the Blockchain. This message is divide into 40 byte blocks, written as separate OPRETURN transaction on the Blockchain. Numbers preceding each block allows for proper concatenation later.
     */
    public function create($public_address, $fee_each, $private_key, $message, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['public_address'] = $public_address;
        $body['fee_each'] = $fee_each;
        $body['private_key'] = $private_key;
        $body['message'] = $message;

        $response = $this->client->post('/messages', $body, $options);

        return $response;
    }

    /**
     * 
     *
     * '/messages/:public_address' GET
     *
     * @param $public_address The public Bitcoin address whose multi-part message are to be read. The stitched, concatenated version is presented.
     */
    public function get($public_address, array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/messages/'.rawurlencode(public_address).'', $body, $options);

        return $response;
    }

}
