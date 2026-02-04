<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PaymentService
{
    protected $consumerKey;
    protected $consumerSecret;
    protected $shortcode;
    protected $passkey;
    protected $stkUrl;
    protected $tokenUrl;
    protected $callbackUrl;

    public function __construct()
    {
        $this->consumerKey = config('mpesa.consumer_key');
        $this->consumerSecret = config('mpesa.consumer_secret');
        $this->shortcode = config('mpesa.shortcode');
        $this->passkey = config('mpesa.passkey');
        $this->stkUrl = config('mpesa.stk_url');
        $this->tokenUrl = config('mpesa.token_url');
        $this->callbackUrl = config('mpesa.callback_url');

    }

    public function getAccessToken()
    {
        $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
            ->get($this->tokenUrl, ['grant_type' => 'client_credentials']);

        return $response->json()['access_token'];
    }

    public function initiateSTKPush($amount, $phone)
    {
        $timestamp = now()->format('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        $body = [
            'BusinessShortCode' => $this->shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $phone,
            'PartyB' => $this->shortcode,
            'PhoneNumber' => $phone,
            'CallBackURL' => route('mpesa.callback'),
            'AccountReference' => 'Payment',
            'TransactionDesc' => 'Payment for services',
        ];

        $response = Http::withToken($this->getAccessToken())->post($this->stkUrl, $body);

        return $response->json();
    }
}
