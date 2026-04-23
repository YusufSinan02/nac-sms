<?php

namespace NacSms\Resources;

class Contact extends BaseResource
{

    public function create(string $gsm, array $data = []): array
    {
        return $this->request('POST', '/contact/create', array_merge([
            'gsm' => $gsm,
        ], $data));
    }

    public function update(string $uuid, array $data): array
    {
        return $this->request('POST', '/contact/update', array_merge(['uuid' => $uuid], $data));
    }

    public function list(array $filters = []): array
    {
        return $this->request('POST', '/contact/list', $filters);
    }

    public function groups(array $filters = []): array
    {
        return $this->request('POST', '/contact/list-group', $filters);
    }

    public function setBlacklist(bool $status, array $gsms = [], array $uuids = [], bool $returnInvalids = false): array
    {
        return $this->request('POST', '/contact/set-blacklist', array_filter([
            'status'         => $status,
            'gsms'           => $gsms ?: null,
            'uuids'          => $uuids ?: null,
            'returnInvalids' => $returnInvalids,
        ]));
    }

}
