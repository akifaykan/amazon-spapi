<?php

namespace App\Services\Interfaces;

/**
 * SPAPIServiceInterface provides an interface for Amazon SP-API.
 * This interface defines the methods that must be implemented by the SPAPIService class.
 */
interface SPAPIServiceInterface
{
    /**
     * Method used to get the Access Token.
     * Returns the token required to access the Amazon API.
     */
    public function getAccessToken(): string;

    /**
     * Method used to send requests to the Amazon API.
     *
     * @param string $method HTTP methods (GET, POST, ...)
     * @param string $endpoint Amazon API endpoint
     * @param array $queryParams Query parameters
     * @param array $body Request body to be sent
     * @return mixed API response
     */
    public function makeRequest(string $method, string $endpoint, array $queryParams = [], array $body = []);
}
