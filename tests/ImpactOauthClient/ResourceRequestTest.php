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
        $this->assertTrue($request->getAccessToken() == 'SomeAccessToken');
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
