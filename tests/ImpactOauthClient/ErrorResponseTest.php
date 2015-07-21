<?php

namespace ImpactOauthClient;

/**
 * Class ErrorResponseTest
 * @package ImpactOauthClient
 */
class ErrorResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testNewInstance()
    {
        $response = new ErrorResponse();
        $this->assertInstanceOf('ImpactOauthClient\ErrorResponse', $response);
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
                "expires" => 'bar',
                "client_id" => 400
            ],
            [
                "access_token" => '',
                "expires" => '',
                "client_id" => null
            ],
            [
                "access_token" => "\n\tBAD",
                "expires" => -1,
                "client_id" => 900000000000
            ]
        ];

        foreach ($testData as $key => $data) {
            $response->setAccessToken($data['access_token']);
            $response->setExpires($data['expires']);
            $response->setClientId($data['client_id']);

            $this->assertTrue($testData[$key]['access_token'] == $response->getAccessToken());
            $this->assertTrue($testData[$key]['expires'] == $response->getExpires());
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
        $response->setExpires($now - 100);
        $this->assertFalse($response->isValid());

        $response->setExpires($now + 100);
        $this->assertTrue($response->isValid());
    }
}
