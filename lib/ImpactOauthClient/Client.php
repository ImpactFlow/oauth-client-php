<?php

namespace ImpactOauthClient;

use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package ImpactOauthClient
 */
class Client
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $guzzleClient;
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @param \GuzzleHttp\Client $guzzle
     */
    public function __construct(\GuzzleHttp\Client $guzzle)
    {
        $this->guzzleClient = $guzzle;
    }

    /**
     * @param TokenRequest $tokenRequest
     * @return TokenResponse|ErrorResponse
     */
    public function requestToken(TokenRequest $tokenRequest)
    {
        $response = $this->guzzleClient->post($tokenRequest->getUri(), ['json' => $tokenRequest->toArray()]);

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
        $response = $this->guzzleClient->get(
            $resourceRequest->getUri(),
            ['query' => $resourceRequest->toArray()]
        );
        if ($resourceRequest->getDeviceToken() && $resourceRequest->getDeviceUri()) {
            $deviceResponse = $this->guzzleClient->get(
                $resourceRequest->getDeviceUri(),
                ['query' => $resourceRequest->toArray()]
            );
            if (!$deviceResponse || $deviceResponse->getStatusCode() !== 200) {
                return $this->populateErrorResponse($deviceResponse);
            }
        }
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
        if (!is_array($json)
            || !array_key_exists('error', $json)
            || !array_key_exists('error_description', $json)
        ) {
            $this->response->setError('Error');
            $this->response->setErrorDescription($response->getBody());
        } else {
            $this->response->setError($json['error']);
            $this->response->setErrorDescription($json['error_description']);
            $this->response->setResponseCode($response->getStatusCode());
        }
        return $this->getResponse();
    }

    /**
     * @param ResponseInterface $response
     * @return TokenResponse
     */
    private function populateTokenResponse(ResponseInterface $response)
    {
        $json = json_decode((string) $response->getBody(), true);

        if (!is_array($json)
            || !array_key_exists('access_token', $json)
            || !array_key_exists('client_id', $json)
            || !array_key_exists('expires', $json)
        ) {
            return $this->populateErrorResponse($response);
        }

        $this->response = new TokenResponse();
        $this->response->setAccessToken($json['access_token']);
        $this->response->setClientId($json['client_id']);
        $this->response->setExpires($json['expires']);
        if (isset($json['user_id'])) {
            $this->response->setUserId($json['user_id']);
        }
        if (isset($json['org_id'])) {
            $this->response->setOrgId($json['org_id']);
        }
        if (isset($json['org_context'])) {
            $this->response->setOrgContext($json['org_context']);
        }
        if (isset($json['scope'])) {
            $this->response->setScope($json['scope']);
        }
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
