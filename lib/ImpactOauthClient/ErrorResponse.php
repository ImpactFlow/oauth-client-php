<?php

namespace ImpactOauthClient;

/**
 * Class ErrorResponse
 * @package ImpactOauthClient
 */
class ErrorResponse implements ResponseInterface
{
    /**
     * @var string
     */
    private $error;
    /**
     * @var string
     */
    private $error_description;
    /**
     * @var int
     */
    private $responseCode;

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getErrorDescription()
    {
        return $this->error_description;
    }

    /**
     * @param string $error_description
     */
    public function setErrorDescription($error_description)
    {
        $this->error_description = $error_description;
    }

    /**
     * @return int
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * @param int $responseCode
     */
    public function setResponseCode($responseCode)
    {
        $this->responseCode = $responseCode;
    }
}
