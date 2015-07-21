<?php

namespace ImpactOauthClient;

/**
 * Class TokenResponse
 * @package ImpactOauthClient
 */
class TokenResponse
{
    /**
     * Token
     * @var string
     */
    private $accessToken;
    /**
     * Unix Time Stamp
     * @var int
     */
    private $expires;
    /**
     * @var string
     */
    private $clientId;

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->getAccessToken() && time() < $this->getExpires();
    }

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
     * @return int
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @param int $expires
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }
}
