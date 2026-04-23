<?php

namespace NacSms;

use GuzzleHttp\Client;
use NacSms\Resources\Sms;
use NacSms\Resources\Contact;
use NacSms\Resources\Account;

class NacSms
{
    protected Client $http;

    public function __construct(
        protected string $username,
        protected string $password,
        protected string $baseUrl = 'https://smslogin.nac.com.tr'
    ) {
        $this->http = new Client([
            'base_uri' => rtrim($this->baseUrl, '/'),
            'headers'  => [
                'Authorization' => 'Basic ' . base64_encode("{$username}:{$password}"),
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ],
        ]);
    }

    public function sms(): Sms
    {
        return new Sms($this->http);
    }

    public function contact(): Contact
    {
        return new Contact($this->http);
    }

    public function account(): Account
    {
        return new Account($this->http);
    }
}
