<?php

namespace App\Classes;

use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

/**
 * PicPay
 */
class PicPay
{

    protected $picpayToken;
    protected $picpaySellerToken;
    protected $baseUrl;

    public function __construct()
    {
        $this->picpayToken = 'Key';
        $this->picpaySellerToken = 'Shop Key';
        $this->baseUrl = 'https://appws.picpay.com/ecommerce/public';
    }
    
    /**
     * payment
     *
     * @param  mixed $product
     * @return void
     */
    public function payment( Array $product)
    {

        $headers = [
            'x-picpay-token' 	=> $this->picpayToken,        
            'x-seller-token'    => $this->picpaySellerToken,
            'Accept'     		=> 'application/json',
        ];

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('POST', $this->baseUrl.'/payments', [
                "headers" => $headers,
                \GuzzleHttp\RequestOptions::JSON => $product
            ]);

            if ($response->getStatusCode() === 200 || $response->getStatusCode() === 201) {

                $body = json_decode($response->getBody()->getContents(), true);

                if ($body) {
                    return ['status' => 'success', 'url' => $body['paymentUrl']];
                } else {
                    return ['status' => 'error', 'return' => json_encode($body)];
                }
            } else {
                return $response->getBody()->getContents();
            }
        } catch (ClientException $e) {
            //echo Psr7\Message::toString($e->getRequest());
            return ['status' => 'error', 'return' => json_decode(Psr7\Message::bodySummary($e->getResponse()), true)];
        }
    }
    
    /**
     * cancel
     *
     * @param  int $referenceId
     * @return void
     */
    public function cancel(int $referenceId)
    {

        $headers = [
            'x-picpay-token' 	=> $this->picpayToken,        
            'x-seller-token'    => $this->picpaySellerToken,
            'Accept'     		=> 'application/json',
        ];

        $client = new \GuzzleHttp\Client();

        $product = ['referenceId' => $referenceId];

        try {
            $response = $client->request('POST', $this->baseUrl.'/payments'.'/'.$referenceId.'/cancellations', [
                "headers" => $headers,
                \GuzzleHttp\RequestOptions::JSON => $product
            ]);

            if ($response->getStatusCode() === 200 || $response->getStatusCode() === 201) {

                $body = json_decode($response->getBody()->getContents(), true);

                if ($body) {
                    return ['status' => 'success', 'return' => $body];
                } else {
                    return ['status' => 'error', 'return' => json_encode($body)];
                }
            } else {
                return $response->getBody()->getContents();
            }
        } catch (ClientException $e) {
            //echo Psr7\Message::toString($e->getRequest());
            return ['status' => 'error', 'return' => json_decode(Psr7\Message::bodySummary($e->getResponse()), true)];
        }

    }
    
    /**
     * status
     *
     * @param  int $referenceId
     * @return void
     */
    public function status(int $referenceId)
    {

        $headers = [
            'x-picpay-token' 	=> $this->picpayToken,        
            'x-seller-token'    => $this->picpaySellerToken,
            'Accept'     		=> 'application/json',
        ];

        $client = new \GuzzleHttp\Client();

        $product = ['referenceId' => $referenceId];

        try {
            $response = $client->request('GET', $this->baseUrl.'/payments'.'/'.$referenceId.'/status', [
                "headers" => $headers
            ]);

            if ($response->getStatusCode() === 200 || $response->getStatusCode() === 201) {

                $body = json_decode($response->getBody()->getContents(), true);

                if ($body) {
                    return ['status' => 'success', 'return' => $body];
                } else {
                    return ['status' => 'error', 'return' => json_encode($body)];
                }
            } else {
                return $response->getBody()->getContents();
            }
        } catch (ClientException $e) {
            //echo Psr7\Message::toString($e->getRequest());
            return ['status' => 'error', 'return' => json_decode(Psr7\Message::bodySummary($e->getResponse()), true)];
        }
    }
    
    /**
     * callback
     *
     * @param  int $referenceId
     * @param  int $authorizationId
     * @return void
     */
    public function callback(int $referenceId, int $authorizationId)
    {
        $headers = [
            'x-picpay-token' 	=> $this->picpayToken,        
            'x-seller-token'    => $this->picpaySellerToken,
            'Accept'     		=> 'application/json',
        ];

        $client = new \GuzzleHttp\Client();

        $product = ['referenceId' => $referenceId, 'authorizationId' => $authorizationId];

        try {
            $response = $client->request('POST', $this->baseUrl.'/callback', [
                "headers" => $headers,
                \GuzzleHttp\RequestOptions::JSON => $product
            ]);

            if ($response->getStatusCode() === 200 || $response->getStatusCode() === 201) {

                $body = json_decode($response->getBody()->getContents(), true);

                if ($body) {
                    return ['status' => 'success', 'return' => $body];
                } else {
                    return ['status' => 'error', 'return' => json_encode($body)];
                }
            } else {
                return $response->getBody()->getContents();
            }
        } catch (ClientException $e) {
            //echo Psr7\Message::toString($e->getRequest());
            return ['status' => 'error', 'return' => json_decode(Psr7\Message::bodySummary($e->getResponse()), true)];
        }
    }
    
}
