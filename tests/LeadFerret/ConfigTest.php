<?php
namespace LeadFerret\Tests\SDK;

use LeadFerret\SDK\Config;
/**
 *
 * @author solvire <stevenjscott@gmail.com>
 * @package package_name
 * @namespace namespace
 */
class ConfigTest extends \BaseTestCase
{

    public function testCanCreateConfig()
    {
        $config = new Config($this->getBasicConfigArray01());
        $this->assertEquals($this->baseUrl,$config->getBaseUrl());
        $this->assertEquals($this->basePath,$config->getBasePath());
        $this->assertEquals($this->applicationName,$config->getApplicationName());
        $this->assertEquals($this->baseUrl . $this->basePath, $config->apiUrl());
        $this->assertEquals(3,count($config->getRequiredFields()));
        
        $config->setBasePath($this->basePath2);
        $config->setBaseUrl($this->baseUrl2);
        $config->setApplicationName($this->applicationName2);
        $this->assertEquals($this->applicationName2, $config->getApplicationName());
        
        $this->assertNotNull($config->getLibraryVersion());
        
    }
    
}