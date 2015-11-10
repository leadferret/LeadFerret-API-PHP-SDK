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
        $baseUrl = 'http://test.com/';
        $basePath = 'public/api';
        $applicationName = 'test-app';
        
        $baseUrl2 = 'http://test.net/';
        $basePath2 = 'public/nothing';
        $applicationName2 = 'test2-app';
        
        $config = new Config([
            'baseUrl' => $baseUrl,
            'basePath' => $basePath,
            'applicationName' => $applicationName
        ]);
        
        
        $this->assertEquals($baseUrl,$config->getBaseUrl());
        $this->assertEquals($basePath,$config->getBasePath());
        $this->assertEquals($applicationName,$config->getApplicationName());
        $this->assertEquals($baseUrl . $basePath, $config->apiUrl());
        $this->assertEquals(3,count($config->getRequiredFields()));
        
        $config->setBasePath($basePath2);
        $config->setBaseUrl($baseUrl2);
        $config->setApplicationName($applicationName2);
        $this->assertEquals($applicationName2, $config->getApplicationName());
        
    }
    
}