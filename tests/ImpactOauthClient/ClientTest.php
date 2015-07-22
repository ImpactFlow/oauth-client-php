<?php

namespace ImpactOauthClient;

/**
 * Class ClientTest
 * @package ImpactOauthClient
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{

    private $mockResponses = [];
    private $guzzleMock;

    /**
     * Setup
     */
    protected function setup()
    {
        $this->initializeMockServerResponses();
        $this->guzzleMock = $this->getMockBuilder('\GuzzleHttp\Client')
            ->getMock();
    }

    /**
     * @test
     */
    public function testGetClientInstance()
    {
        $client = new Client($this->guzzleMock);

        $this->assertInstanceOf('ImpactOauthClient\Client', $client);
    }

    /**
     * @test
     */
    public function testRequestToken()
    {

        $guzzleMock = $this->getMockBuilder('\GuzzleHttp\Client')
            ->setMethods(['post'])
            ->getMock();

        $httpResponseMock = $this->getMockBuilder('GuzzleHttp\Psr7\Response')
            ->getMock();
        $httpResponseMock->method('getStatusCode')
            ->willReturn(200);
        $httpResponseMock->method('getBody')
            ->willReturn('{"access_token":"foo","client_id":"bar","expires_in":123}');
        $guzzleMock->method('post')
            ->willReturn($httpResponseMock);

        $client = new Client($guzzleMock);
        $tokenRequest = $this->getMockBuilder('ImpactOauthClient\TokenRequest')
            ->getMock();

        $requestArr = [];
        $tokenRequest->expects($this->any())
            ->method('toArray')
            ->will($this->returnValue($requestArr));
        $response = $client->requestToken($tokenRequest);
        $this->assertInstanceOf('ImpactOauthClient\TokenResponse', $response);
        $this->assertTrue($response->getAccessToken() == 'foo');
        $this->assertTrue($response->getClientId() == 'bar');
        $this->assertTrue($response->getExpiresIn() == 123);
    }

    /**
     * @test
     */
    public function testRequestTokenBadResponse()
    {

        $guzzleMock = $this->getMockBuilder('\GuzzleHttp\Client')
            ->setMethods(['post'])
            ->getMock();

        $httpResponseMock = $this->getMockBuilder('GuzzleHttp\Psr7\Response')
            ->getMock();
        $httpResponseMock->method('getStatusCode')
            ->willReturn(200);
        $httpResponseMock->method('getBody')
            ->willReturn('Unknown Error');
        $guzzleMock->method('post')
            ->willReturn($httpResponseMock);

        $client = new Client($guzzleMock);
        $tokenRequest = $this->getMockBuilder('ImpactOauthClient\TokenRequest')
            ->getMock();

        $requestArr = [];
        $tokenRequest->expects($this->any())
            ->method('toArray')
            ->will($this->returnValue($requestArr));
        $response = $client->requestToken($tokenRequest);
        $this->assertInstanceOf('ImpactOauthClient\ErrorResponse', $response);
        $this->assertTrue($response->getError() == 'Error');
        $this->assertTrue($response->getErrorDescription() == 'Unknown Error');
    }


    /**
     * @test
     */
    public function testValidateToken()
    {
        $guzzleMock = $this->getMockBuilder('\GuzzleHttp\Client')
            ->setMethods(['get'])
            ->getMock();

        $httpResponseMock = $this->getMockBuilder('GuzzleHttp\Psr7\Response')
            ->getMock();
        $httpResponseMock->method('getStatusCode')
            ->willReturn(200);
        $httpResponseMock->method('getBody')
            ->willReturn('{"access_token":"foo","client_id":"bar","expires_in":123}');

        $guzzleMock->method('get')
            ->willReturn($httpResponseMock);

        $client = new Client($guzzleMock);
        $resourceRequest = $this->getMockBuilder('ImpactOauthClient\ResourceRequest')
            ->getMock();

        $requestArr = [];
        $resourceRequest->expects($this->any())
            ->method('toArray')
            ->will($this->returnValue($requestArr));
        $response = $client->validateToken($resourceRequest);
        $this->assertInstanceOf('ImpactOauthClient\TokenResponse', $response);
        $this->assertTrue($response->getAccessToken() == 'foo');
        $this->assertTrue($response->getClientId() == 'bar');
        $this->assertTrue($response->getExpiresIn() == 123);
    }

    /**
     * @test
     */
    public function testErrorResponse()
    {
        $guzzleMock = $this->getMockBuilder('\GuzzleHttp\Client')
            ->setMethods(['get'])
            ->getMock();

        $httpResponseMock = $this->getMockBuilder('GuzzleHttp\Psr7\Response')
            ->getMock();
        $httpResponseMock->method('getStatusCode')
            ->willReturn(401);
        $httpResponseMock->method('getBody')
            ->willReturn('{"error":"foo","error_description":"bar"}');

        $guzzleMock->method('get')
            ->willReturn($httpResponseMock);

        $client = new Client($guzzleMock);
        $resourceRequest = $this->getMockBuilder('ImpactOauthClient\ResourceRequest')
            ->getMock();

        $requestArr = [];
        $resourceRequest->expects($this->any())
            ->method('toArray')
            ->will($this->returnValue($requestArr));
        $response = $client->validateToken($resourceRequest);
        $this->assertInstanceOf('ImpactOauthClient\ErrorResponse', $response);
        $this->assertTrue($response->getError() == 'foo');
        $this->assertTrue($response->getErrorDescription() == 'bar');
        $this->assertTrue($response->getResponseCode() == 401);
    }

    private function initializeMockServerResponses()
    {
        $this->mockResponses [] = '{"access_token":"abc","expires_in":3600,"token_type":"Bearer","scope":null}';
        $this->mockResponses [] = '{"access_token":"def","expires_in":3600,"token_type":"Bearer","scope":null}';
        $this->mockResponses [] = '{"access_token":"ghi","expires_in":3600,"token_type":"Bearer","scope":null}';
        $this->mockResponses [] = '{"access_token":"jkl","expires_in":3600,"token_type":"Bearer","scope":null}';
    }
}
