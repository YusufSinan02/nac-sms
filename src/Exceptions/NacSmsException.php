<?php

namespace NacSms\Exceptions;

use Exception;

class NacSmsException extends Exception
{
    public function __construct(string $message, protected string $apiCode = '')
    {
        parent::__construct($message);
    }

    public function getApiCode(): string
    {
        return $this->apiCode;
    }
}
