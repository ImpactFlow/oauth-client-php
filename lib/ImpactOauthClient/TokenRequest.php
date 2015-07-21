<?php

namespace ImpactOauthClient;

/**
 * Class TokenRequest
 * @package ImpactOauthClient
 */
class TokenRequest
{
    /**
     * @var string
     */
    private $clientId = null;

    /**
     * @var string
     */
    private $clientSecret = null;

    /**
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct($clientId = null, $clientSecret = null)
    {
        if (!is_null($clientId)) {
            $this->setClientId($clientId);
            $this->setClientSecret($clientSecret);
        }
    }

    /**
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        if (!$this->clientId) {
            throw new \RuntimeException("Invalid Or Missing Client ID");
        }
        return $this->clientId;
    }

    /**
     * @param string $clientSecret
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        if (!$this->clientSecret) {
            throw new \RuntimeException("Invalid Or Missing Client Secret");
        }
        return $this->clientSecret;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            "client_id" => $this->getClientId(),
            "client_secret" => $this->getClientSecret(),
            "grant_type" => "client_credentials"
        ];
    }
}
