<?php

namespace ImpactOauthClient;

/**
 * Class TokenResponse
 * @package ImpactOauthClient
 */
class TokenResponse implements ResponseInterface
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
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $orgId;

    /**
     * @var bool
     */
    private $useDeviceHash;

    /**
     * @var string
     */
    private $orgContext;

    /**
     * @var string
     */
    private $scope;

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

    /**
     * @return int
     */
    public function getResponseCode()
    {
        return 200;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getOrgId()
    {
        return $this->orgId;
    }

    /**
     * @param $orgId
     */
    public function setOrgId($orgId)
    {
        $this->orgId = $orgId;
    }

    /**
     * @return bool
     */
    public function getUseDeviceHash()
    {
        return $this->useDeviceHash;
    }

    /**
     * @param bool $useDeviceHash
     */
    public function setUseDeviceHash($useDeviceHash)
    {
        $this->useDeviceHash = $useDeviceHash;
    }

    /**
     * @return string
     */
    public function getOrgContext()
    {
        return $this->orgContext;
    }

    /**
     * @param string $orgContext
     */
    public function setOrgContext($orgContext)
    {
        $this->orgContext = $orgContext;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param string $scope
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
    }
}
