<?php

namespace App\Http\Services\IdeaSoft;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IdeaSoftCallService
{
    const TOKEN_URL = "https://sergikur.myideasoft.com/oauth/v2/token";

    private Client $client;
    private string $clientSecret;
    private string $clientId;
    private null|string $accessToken = null;

    public function __construct()
    {
        $this->client = new Client([
            'http_errors' => false,
        ]);
        $this->clientId = config("ideasoft.client_id");
        $this->clientSecret = config("ideasoft.client_secret");

        if ($this->tokenHasExpired() && Cache::has('refresh_token')) {
            $this->token(type: "refresh_token");
        }else {
            $this->accessToken = Cache::get('access_token');
        }
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function getAccessToken(): null|string
    {
        return $this->accessToken;
    }

    public function token(string $type = "authorization_code", null|string $code = null): void {
        try {
            $q = [
                "grant_type" => $type,
                "client_id" => $this->getClientId(),
                "client_secret" => $this->getClientSecret(),
            ];

            if ($type === "authorization_code") {
                $q['code'] = $code;
                $q['redirect_uri'] = route('ideasoft.authorize');
            }else {
                $q['refresh_token'] = Cache::get('refresh_token');
            }

            $request = $this->getClient()->get(self::TOKEN_URL, [
                "query" => $q
            ]);
            $data = json_decode($request->getBody()->getContents(), true);

            if (isset($data['error']) && isset($data['error_description'])) {
                throw new Exception($data['error_description']);
            }

            Cache::put('access_token', $data['access_token'], $data['expires_in']);
            Cache::put('refresh_token', $data['refresh_token']);
            Cache::put('scope', $data['scope'], $data['expires_in']);

            $this->accessToken = $data['access_token'];
        } catch (GuzzleException $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function tokenHasExpired(): bool {
        return !Cache::has('access_token');
    }
}
