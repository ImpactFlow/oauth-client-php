<?php

namespace ImpactOauthClient;

use GuzzleHttp\Client;

/**
 * Class ResourceClient
 * @package ImpactOauthClient
 */
class ResourceClient
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $guzzleClient;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $deviceHash;

    /**
     * @var string 
     */
    private $uri;

    /**
     * ResourceClient constructor.
     * @param Client $guzzle
     * @param string $accessToken
     * @param string $deviceHash
     * @param string $uri
     */
    public function __construct (Client $guzzle, $accessToken, $deviceHash, $uri)
    {
        $this->guzzleClient = $guzzle;
        $this->accessToken = $accessToken;
        $this->deviceHash = $deviceHash;
        $this->uri = $uri;
    }

    /**
     * @return TokenResponse|ErrorResponse
     */
    public function validateToken()
    {
        $resourceRequest = new ResourceRequest();
        $resourceRequest->setAccessToken($this->accessToken);
        $resourceRequest->setDeviceToken($this->deviceHash);
        $resourceRequest->setUri($this->uri);

        $client = new \ImpactOauthClient\Client($this->guzzleClient);

        return $client->validateToken($resourceRequest);
    }
}
