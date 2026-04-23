<?php

namespace NacSms\Resources;

class Account extends BaseResource
{

    public function credit(): array
    {
        return $this->request('GET', '/user/credit');
    }

    public function senders(): array
    {
        return $this->request('GET', '/sms/list-sender');
    }

    public function gateways(): array
    {
        return $this->request('GET', '/sms/list-gateway');
    }

}
