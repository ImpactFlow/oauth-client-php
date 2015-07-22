<?php

namespace ImpactOauthClient;

/**
 * Class TokenResponseTest
 * @package ImpactOauthClient
 */
class TokenResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testNewInstance()
    {
        $response = new TokenResponse();
        $this->assertInstanceOf('ImpactOauthClient\TokenResponse', $response);
    }

    /**
     * @test
     */
    public function testGettersSetters()
    {
        $response = new TokenResponse();
        $testData = [
            [
                "access_token" => 'foo',
                "expires_in" => 'bar',
                "client_id" => 400
            ],
            [
                "access_token" => '',
                "expires_in" => '',
                "client_id" => null
            ],
            [
                "access_token" => "\n\tBAD",
                "expires_in" => -1,
                "client_id" => 900000000000
            ]
        ];

        foreach ($testData as $key => $data) {
            $response->setAccessToken($data['access_token']);
            $response->setExpiresIn($data['expires_in']);
            $response->setClientId($data['client_id']);

            $this->assertTrue($testData[$key]['access_token'] == $response->getAccessToken());
            $this->assertTrue($testData[$key]['expires_in'] == $response->getExpiresIn());
            $this->assertTrue($testData[$key]['client_id'] == $response->getClientId());
        }

    }

    /**
     * @test
     */
    public function testIsValid()
    {
        $response = new TokenResponse();
        $response->setAccessToken('some token');
        $now = time();
        $response->setExpiresIn($now - 100);
        $this->assertFalse($response->isValid());

        $response->setExpiresIn($now + 100);
        $this->assertTrue($response->isValid());
    }
}
