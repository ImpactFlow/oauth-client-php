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
    private $expiresIn;
    /**
     * @var string
     */
    private $clientId;

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->getAccessToken() && time() < $this->getExpiresIn();
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
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * @param int $expiresIn
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
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
