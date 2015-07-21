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
        $response = new ErrorResponse();
        $testData = [
            [
                "error" => 'foo',
                "error_description" => 'bar',
                "response_code" => 400
            ],
            [
                "error" => '',
                "error_description" => '',
                "response_code" => null
            ],
            [
                "error" => "\n\tBAD",
                "error_description" => -1,
                "response_code" => 900000000000
            ]
        ];

        foreach ($testData as $key => $data) {
            $response->setError($data['error']);
            $response->setErrorDescription($data['error_description']);
            $response->setResponseCode($data['response_code']);

            $this->assertTrue($testData[$key]['error'] == $response->getError());
            $this->assertTrue($testData[$key]['error_description'] == $response->getErrorDescription());
            $this->assertTrue($testData[$key]['response_code'] == $response->getResponseCode());
        }
    }
}
