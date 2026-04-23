<?php

namespace NacSms\Resources;

class Sms extends BaseResource
{
    public function send(string $number, string $content, string $title, array $options = [], ?string $sender = null): array
    {
        return $this->request('POST', '/sms/create', array_merge([
            'type'        => 1,
            'sendingType' => 0,
            'number'      => $number,
            'sender'      => $sender ?? config('nac-sms.sender'),
            'title'       => $title,
            'content'     => $content,
            'encoding'    => 1,
        ], $options));
    }

    public function sendBulk(array $numbers, string $content, string $title, array $options = [], ?string $sender = null): array
    {
        return $this->request('POST', '/sms/create', array_merge([
            'type'        => 1,
            'sendingType' => 1,
            'numbers'     => $numbers,
            'sender'      => $sender ?? config('nac-sms.sender'),
            'title'       => $title,
            'content'     => $content,
            'encoding'    => 1,
        ], $options));
    }

    public function sendDynamic(array $numbers, string $title, array $options = [], ?string $sender = null): array
    {
        return $this->request('POST', '/sms/create', array_merge([
            'type'        => 1,
            'sendingType' => 2,
            'numbers'     => $numbers,
            'sender'      => $sender ?? config('nac-sms.sender'),
            'title'       => $title,
            'encoding'    => 1,
        ], $options));
    }

    public function sendOtp(string $number, string $content, string $title, ?string $sender = null): array
    {
        return $this->request('POST', '/sms/create-otp', [
            'type'        => 1,
            'sendingType' => 0,
            'number'      => $number,
            'sender'      => $sender ?? config('nac-sms.sender'),
            'title'       => $title,
            'content'     => $content,
            'encoding'    => 1,
        ]);
    }

    public function sendScheduled(string|array $numbers, string $content, string $title, string $sendingDate, ?string $sender = null): array
    {
        $key = is_array($numbers) ? 'numbers' : 'number';

        return $this->request('POST', '/sms/create', [
            'type'        => 1,
            'sendingType' => 0,
            $key          => $numbers,
            'sender'      => $sender ?? config('nac-sms.sender'),
            'title'       => $title,
            'content'     => $content,
            'encoding'    => 1,
            'sendingDate' => $sendingDate,
        ]);
    }

    public function cancel(int $id, ?string $customID = null): array
    {
        return $this->request('POST', '/sms/cancel', array_filter([
            'id'       => $id,
            'customID' => $customID,
        ]));
    }

    public function report(string $startDate, string $finishDate, array $filters = []): array
    {
        return $this->request('POST', '/sms/list', array_merge([
            'startDate'  => $startDate,
            'finishDate' => $finishDate,
        ], $filters));
    }

    public function reportItems(int $pkgID, array $filters = []): array
    {
        return $this->request('POST', '/sms/list-item', array_merge([
            'pkgID' => $pkgID,
        ], $filters));
    }

    public function summary(string $startDate, string $finishDate): array
    {
        return $this->request('POST', '/sms/summary', [
            'startDate'  => $startDate,
            'finishDate' => $finishDate,
        ]);
    }

    public function inquiry(string $gsm, string $sender, string $startDate, string $finishDate): array
    {
        return $this->request('POST', '/sms/inquiry-number', [
            'gsm'        => $gsm,
            'sender'     => $sender,
            'startDate'  => $startDate,
            'finishDate' => $finishDate,
        ]);
    }

    public function getMo(string $startDate, string $finishDate, array $filters = []): array
    {
        return $this->request('POST', '/sms/get-mo', array_merge([
            'startDate'  => $startDate,
            'finishDate' => $finishDate,
        ], $filters));
    }

    public function senders(array $filters = []): array
    {
        return $this->request('POST', '/sms/list-sender', $filters);
    }

    public function gateways(): array
    {
        return $this->request('GET', '/sms/list-gateway');
    }
}
