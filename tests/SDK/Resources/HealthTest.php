<?php
namespace LeadFerret\Tests\SDK\Resources;

use LeadFerret\SDK\Resources\Health;
use LeadFerret\SDK\Config;

/**
 *
 * @group Resources
 * 
 * @author solvire <stevenjscott@gmail.com>
 * @package Resources
 * @namespace LeadFerret\Tests\SDK\Resources
 */
class HealthTest extends \BaseTestCase
{

    public function testCanPollHealth()
    {
        $resource = new Health(new Config($this->getBasicConfigArray01()));
        $resource->get()->getBody();
        
        $this->assertTrue($resource->alive());
    }
}