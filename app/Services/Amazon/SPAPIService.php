<?php

namespace App\Services\Amazon;

use App\Services\Interfaces\SPAPIServiceInterface;
use Illuminate\Support\Facades\Http;

class SPAPIService implements SPAPIServiceInterface
{
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;
    protected $refreshToken;

    /**
     * SPAPIService constructor.
     * Initializes the necessary configurations for the API.
     */
    public function __construct()
    {
        $this->baseUrl = config('spapi.base_url');
        $this->clientId = config('spapi.client_id');
        $this->clientSecret = config('spapi.client_secret');
        $this->refreshToken = config('spapi.refresh_token');
    }

    /**
     * Method used to get the Access Token.
     */
    public function getAccessToken(): string
    {
        $response = Http::asForm()->post("{$this->baseUrl}/auth/o2/token", [
            'grant_type' => 'refresh_token',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $this->refreshToken,
        ]);

        if ($response->successful()) {
            return $response->json()['access_token'];
        }

        throw new \Exception('Unable to fetch access token');
    }

    /**
     * Method used to send requests to the Amazon API.
     */
    public function makeRequest(string $method, string $endpoint, array $queryParams = [], array $body = [])
    {
        $token = $this->getAccessToken();

        $response = Http::withToken($token)->$method("{$this->baseUrl}/{$endpoint}", [
            'query' => $queryParams,
            'json' => $body,
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API Request failed: ' . $response->body());
    }
}
