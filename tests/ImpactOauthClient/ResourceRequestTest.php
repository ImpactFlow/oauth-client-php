<?php

namespace ImpactOauthClient;

/**
 * Class ResourceRequestTest
 * @package ImpactOauthClient
 */
class ResourceRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testNewInstance()
    {
        $request = new ResourceRequest();
        $this->assertInstanceOf('ImpactOauthClient\ResourceRequest', $request);
        $this->assertNull($request->getAccessToken());
    }

    /**
     * @test
     */
    public function testSetters()
    {
        $request = new ResourceRequest();
        $request->setAccessToken('SomeAccessToken');
        $request->setUri("https://somewhere");
        $request->setDeviceUri("https://deviceHere");
        $request->setDeviceToken("123MyDeviceHash");
        $this->assertTrue($request->getAccessToken() == 'SomeAccessToken');
        $this->assertTrue($request->getUri() == "https://somewhere");
        $this->assertTrue($request->getDeviceToken() == "123MyDeviceHash");
        $this->assertTrue($request->getDeviceUri() == "https://deviceHere");
    }

    /**
     * @test
     */
    public function testToArray()
    {
        $request = new ResourceRequest();
        $request->setAccessToken('SomeAccessToken');
        $arr = $request->toArray();

        $this->assertTrue(is_array($arr));
        $this->assertTrue($arr['access_token'] == $request->getAccessToken());
    }
}
