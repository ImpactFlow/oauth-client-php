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
                "client_id" => 400,
                "user_id" => 123,
                "org_id" => 1,
            ],
            [
                "access_token" => '',
                "expires_in" => '',
                "client_id" => null,
                "user_id" => 0,
                "org_id" => 0,
            ],
            [
                "access_token" => "\n\tBAD",
                "expires_in" => -1,
                "client_id" => 900000000000,
                "user_id" => "BAD",
                "org_id" => "BAD",
            ]
        ];

        foreach ($testData as $key => $data) {
            $response->setAccessToken($data['access_token']);
            $response->setExpires($data['expires_in']);
            $response->setClientId($data['client_id']);
            $response->setUserId($data['user_id']);
            $response->setOrgId($data['org_id']);

            $this->assertTrue($testData[$key]['access_token'] == $response->getAccessToken());
            $this->assertTrue($testData[$key]['expires_in'] == $response->getExpires());
            $this->assertTrue($testData[$key]['client_id'] == $response->getClientId());
            $this->assertTrue($testData[$key]['user_id'] == $response->getUserId());
            $this->assertTrue($testData[$key]['org_id'] == $response->getOrgId());
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

    /**
     * @test
     */
    public function testResponseCode()
    {
        $response = new TokenResponse();
        $this->assertEquals($response->getResponseCode(), 200);
    }
}
