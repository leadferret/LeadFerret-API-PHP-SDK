<?php

/**
 * 
 * @author solvire <stevenjscott@gmail.com>
 * @package Tests
 * @namespace LeadFerret\Tests
 */
class BaseTestCase extends PHPUnit_Framework_TestCase
{
    
    public $baseUrl = 'http://test.com/';
    public $basePath = 'public/api';
    public $applicationName = 'test-app';
    
    public $baseUrl2 = 'http://test.net/';
    public $basePath2 = 'public/nothing';
    public $applicationName2 = 'test2-app';
    

    /**
     * @return array 
     */
    public function getBasicConfigArray01()
    {
        return [
            'baseUrl' => $this->baseUrl,
            'basePath' => $this->basePath,
            'applicationName' => $this->applicationName
        ];
    }
    
    
    /**
     * @return array
     */
    public function getBasicConfigArray02()
    {
        return [
            'baseUrl' => $this->baseUrl2,
            'basePath' => $this->basePath2,
            'applicationName' => $this->applicationName2
        ];
    }
	
}