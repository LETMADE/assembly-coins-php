<?php

namespace AssemblyCoins\Api;

use AssemblyCoins\HttpClient\HttpClient;

/**
 * <no value>
 */
class Transactions
{

    private $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * 
     *
     * '/transactions/transfer' POST
     *
     * @param $from_public_address  The public address sending colored coins. It must have enough colored coins and bitcoins for the transfer transactions to succeed.
     * @param $from_private_key The private key of the sending public address.
     * @param $transfer_amount The number of colored coins to transfer. This is in units of the minimum increment for the color type.
     * @param $issuing_address The source address of the color being transferred. This is the founder and controlling address of the color type and the only address that can issue further coins. It identifies the desired color to send, in case of color mixing.
     * @param $fee_each The amount in Bitcoin transaction fees to spent per transaction. Suggested 0.00005.
     * @param $to_public_address The destination for the transferred colored coins.
     */
    public function create($from_public_address, $from_private_key, $transfer_amount, $issuing_address, $fee_each, $to_public_address, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['from_public_address'] = $from_public_address;
        $body['from_private_key'] = $from_private_key;
        $body['transfer_amount'] = $transfer_amount;
        $body['issuing_address'] = $issuing_address;
        $body['fee_each'] = $fee_each;
        $body['to_public_address'] = $to_public_address;

        $response = $this->client->post('/transactions/transfer', $body, $options);

        return $response;
    }

    /**
     * 
     *
     * '/transactions' POST
     *
     * @param $transaction_hex The raw transaction, in hex form, to be pushed directly to the Bitcoin Network.
     */
    public function createRaw($transaction_hex, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['transaction_hex'] = $transaction_hex;

        $response = $this->client->post('/transactions', $body, $options);

        return $response;
    }

    /**
     * 
     *
     * '/transactions/parsed/:block_height' GET
     *
     * @param $block_height The height of the Bitcoin Block to inspect. Parsed Colored Coin Metadata will be presented for that Block. Metadata is not checked for legitimacy, merely interpreted from OPRETURNS.
     */
    public function getBlock($block_height, array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/transactions/parsed/'.rawurlencode(block_height).'', $body, $options);

        return $response;
    }

    /**
     * 
     *
     * '/transactions/raw/:transaction_hash' GET
     *
     * @param $transaction_hash The Bitcoin transaction hash to lookup. Bitcoin transaction information is returned.
     */
    public function getRaw($transaction_hash, array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/transactions/raw/'.rawurlencode(transaction_hash).'', $body, $options);

        return $response;
    }

    /**
     * 
     *
     * '/transactions/:transaction_hash' GET
     *
     * @param $transaction_hash The Bitcoin transaction hash to lookup. Verified Colored Coin Data is returned.
     */
    public function get($transaction_hash, array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/transactions/'.rawurlencode(transaction_hash).'', $body, $options);

        return $response;
    }

}
