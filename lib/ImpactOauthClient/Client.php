<?php

namespace ImpactOauthClient;

use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package ImpactOauthClient
 */
class Client
{
    const TOKEN_ENDPOINT = '/token';
    const RESOURCE_ENDPOINT = '/resource';

    /**
     * @var \GuzzleHttp\Client
     */
    private $guzzleClient = null;
    /**
     * @var TokenResponse|ErrorResponse
     * @todo create Response Interface
     */
    private $response = null;

    /**
     * @param \GuzzleHttp\Client $guzzle
     */
    public function __construct (\GuzzleHttp\Client $guzzle)
    {
        $this->guzzleClient = $guzzle;
    }

    /**
     * @param TokenRequest $tokenRequest
     * @return TokenResponse|ErrorResponse
     */
    public function requestToken(TokenRequest $tokenRequest)
    {
        $response = $this->guzzleClient->post(self::TOKEN_ENDPOINT, ['json' => $tokenRequest->toArray()]);

        return ($response->getStatusCode() == 200)
            ? $this->populateTokenResponse($response)
            : $this->populateErrorResponse($response);
    }

    /**
     * @param ResourceRequest $resourceRequest
     * @return TokenResponse|ErrorResponse
     */
    public function validateToken(ResourceRequest $resourceRequest)
    {
        $response = $this->guzzleClient->get(self::RESOURCE_ENDPOINT, ['query' => $resourceRequest->toArray()]);

        return ($response->getStatusCode() == 200)
            ? $this->populateTokenResponse($response)
            : $this->populateErrorResponse($response);
    }

    /**
     * @param ResponseInterface $response
     * @return ErrorResponse
     */
    private function populateErrorResponse(ResponseInterface $response)
    {
        $this->response = new ErrorResponse();
        $json = json_decode((string) $response->getBody(), true);
        $this->response->setError($json['error']);
        $this->response->setErrorDescription($json['error_description']);
        $this->response->setResponseCode($response->getStatusCode());
        return $this->getResponse();
    }

    /**
     * @param ResponseInterface $response
     * @return TokenResponse
     */
    private function populateTokenResponse(ResponseInterface $response)
    {
        $this->response = new TokenResponse();
        $json = json_decode((string) $response->getBody(), true);
        $this->response->setAccessToken($json['access_token']);
        $this->response->setClientId($json['client_id']);
        $this->response->setExpires($json['expires']);
        return $this->getResponse();
    }

    /**
     * @return TokenResponse|ErrorResponse
     */
    public function getResponse()
    {
        return $this->response;
    }
}
