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
    private $deviceToken = null;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $deviceUri = null;

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
     * @return string
     */
    public function getDeviceToken()
    {
        return $this->deviceToken;
    }

    /**
     * @param string $deviceToken
     */
    public function setDeviceToken($deviceToken)
    {
        $this->deviceToken = $deviceToken;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'access_token' => $this->getAccessToken(),
            'device_hash' => $this->getDeviceToken()
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
     * @param string $deviceUri
     */
    public function setUri($uri, $deviceUri = null)
    {
        $this->uri = $uri;
        $this->deviceUri = $deviceUri;
    }

    /**
     * @return string
     */
    public function getDeviceUri()
    {
        return $this->deviceUri;
    }

    /**
     * @param string $deviceUri
     */
    public function setDeviceUri($deviceUri)
    {
        $this->deviceUri = $deviceUri;
    }
}
