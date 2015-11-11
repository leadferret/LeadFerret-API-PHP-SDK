<?php
namespace LeadFerret\Tests\SDK;


use LeadFerret\SDK\Config;
use LeadFerret\SDK\LFClient;
/**
 *
 * @author solvire
 * @package LeadFerret\SDK
 * @name sapce LeadFerret\SDK
 */
class LFClientTest extends \BaseTestCase
{
    
    
    public function testCanBuildClient()
    {
        
        $client = new LFClient(new Config($this->getBasicConfigArray01()));
        $this->assertInstanceOf('\LeadFerret\SDK\LFClient', $client);
        
    }

}
    