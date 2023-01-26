<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class OneSignalService
{
    private string $apiKey;

    private string $apiUrl;

    private string $appId;

    public function __construct()
    {
        $this->apiKey = config("onesignal.api_key");
        $this->apiUrl = config("onesignal.api_url");
        $this->appId = config("onesignal.app_id");
    }

    public function call(string $method, string $url, array $options = []): array
    {
        $client = new Client([
            'base_uri' => $this->apiUrl,
            'http_errors' => false,
            'headers' => [
                'accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => sprintf('Basic %s', $this->apiKey),
            ]
        ]);

        $options['json'] = $options;
        $options['json']['app_id'] = $this->appId;

        try {
            $response = $client->request($method, $url, $options);

            if ($response->getStatusCode() !== 200) {
                throw new UnprocessableEntityHttpException($response->getBody()->getContents());
            }

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException) {
            throw new UnprocessableEntityHttpException("CONNECTION_ERROR");
        }
    }
}
