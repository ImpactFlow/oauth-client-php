<?php

namespace ImpactOauthClient;

/**
 * Class ResourceRequest
 * @package ImpactOauthClient
 */
class ResourceRequest
{
    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $uri;

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'access_token' => $this->getAccessToken()
        ];
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }
}
