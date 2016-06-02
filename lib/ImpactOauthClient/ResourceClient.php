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
    private $resourceUri;

    /**
     * @var string
     */
    private $deviceUri;

    /**
     * ResourceClient constructor.
     * @param Client $guzzle
     * @param string $accessToken
     * @param string $deviceHash
     * @param string $resourceUri
     * @param string $deviceUri
     */
    public function __construct (Client $guzzle, $accessToken, $deviceHash, $resourceUri, $deviceUri)
    {
        $this->guzzleClient = $guzzle;
        $this->accessToken = $accessToken;
        $this->deviceHash = $deviceHash;
        $this->resourceUri = $resourceUri;
        $this->deviceUri = $deviceUri;
    }

    /**
     * @return TokenResponse|ErrorResponse
     */
    public function validateToken()
    {
        $resourceRequest = new ResourceRequest();
        $resourceRequest->setAccessToken($this->accessToken);
        $resourceRequest->setDeviceToken($this->deviceHash);
        $resourceRequest->setUri($this->resourceUri, $this->deviceUri);

        $client = new \ImpactOauthClient\Client($this->guzzleClient);

        return $client->validateToken($resourceRequest);
    }
}
