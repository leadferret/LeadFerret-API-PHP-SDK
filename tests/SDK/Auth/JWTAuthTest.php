<?php
namespace LeadFerret\Tests\SDK\Auth;

use LeadFerret\SDK\Config;
use LeadFerret\SDK\LFClient;

/**
 *
 * @author solvire
 * @package LeadFerret\SDK
 * @name sapce LeadFerret\SDK
 */
class JWTAuthTest extends \BaseTestCase
{

    public function testCanAuthenticateClient()
    {
        $client = new LFClient(new Config($this->getBasicConfigArray01()));
        $this->assertInstanceOf('\LeadFerret\SDK\LFClient', $client);
        $client->authenticate();
        $token = $client->getToken();
        
        // not sure what to check here.
        $this->assertTrue(count(explode('.', $token)) == 3);
    }
}
    