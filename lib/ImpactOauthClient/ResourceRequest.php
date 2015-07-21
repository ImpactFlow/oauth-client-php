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
}
