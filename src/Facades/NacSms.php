<?php

namespace NacSms\Facades;

use Illuminate\Support\Facades\Facade;
use NacSms\Resources\Sms;
use NacSms\Resources\Contact;
use NacSms\Resources\Account;

/**
 * @method static Sms     sms()     SMS gönderim, rapor ve yönetim
 * @method static Contact contact() Rehber ve kara liste yönetimi
 * @method static Account account() Kredi, sender ve gateway sorgulama
 *
 * @see \NacSms\NacSms
 */
class NacSms extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'nac-sms';
    }
}
