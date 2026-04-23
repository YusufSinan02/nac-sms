<?php

namespace NacSms\Resources;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use NacSms\Exceptions\NacSmsException;

abstract class BaseResource
{
    public function __construct(protected Client $http) {}

    protected function request(string $method, string $uri, array $body = []): array
    {
        try {
            $options  = $method === 'GET' ? ['query' => $body] : ['json' => $body];
            $response = $this->http->request($method, $uri, $options);
            $data     = json_decode($response->getBody()->getContents(), true);

            if (($data['err']['status'] ?? 0) !== 0) {
                throw new NacSmsException(
                    $data['err']['message'] ?? 'Bilinmeyen hata',
                    (string) ($data['err']['code'] ?? '')
                );
            }

            return $data['data'] ?? [];
        } catch (NacSmsException $e) {
            throw $e;
        } catch (GuzzleException $e) {
            throw new NacSmsException('HTTP isteği başarısız: ' . $e->getMessage());
        }
    }
}
