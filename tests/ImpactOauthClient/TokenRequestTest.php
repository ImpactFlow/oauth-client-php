<?php

namespace ImpactOauthClient;

/**
 * Class TokenRequestTest
 * @package ImpactOauthClient
 */
class TokenRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testNewInstance()
    {
        $request = new TokenRequest();
        $this->assertInstanceOf('ImpactOauthClient\TokenRequest', $request);

        $request = new TokenRequest('MyClientId', 'MySecret');
        $this->assertTrue($request->getClientId() == 'MyClientId');
        $this->assertTrue($request->getClientSecret() == 'MySecret');

        $request = new TokenRequest('MyClientId', null);
        $this->assertNotNull($request->getClientId());
    }

    /**
     * @test
     */
    public function testSetters()
    {
        $request = new TokenRequest();
        $request->setClientId('MyClientId');
        $request->setClientSecret('MySecret');
        $this->assertTrue($request->getClientId() == 'MyClientId');
        $this->assertTrue($request->getClientSecret() == 'MySecret');
    }

    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Invalid Or Missing Client ID
     */
    public function testInvalidClientId()
    {
        $request = new TokenRequest();
        $request->setClientId(null);
        $request->getClientId();
    }
    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Invalid Or Missing Client Secret
     */
    public function testInvalidClientSecret()
    {
        $request = new TokenRequest();
        $request->setClientSecret(null);
        $request->getClientSecret();
    }

    /**
     * @test
     */
    public function testToArray()
    {
        $request = new TokenRequest();
        $request->setClientId('MyClientId');
        $request->setClientSecret('MySecret');
        $arr = $request->toArray();

        $this->assertTrue(is_array($arr));
        $this->assertTrue($arr['client_id'] == $request->getClientId());
        $this->assertTrue($arr['client_secret'] == $request->getClientSecret());
        $this->assertTrue($arr['grant_type'] == 'client_credentials');
    }
}
