<?php

/**
 * 
 * @author solvire <stevenjscott@gmail.com>
 * @package Tests
 * @namespace LeadFerret\Tests
 */
class BaseTestCase extends PHPUnit_Framework_TestCase
{
    
    public $baseUrl = 'http://development.leadferret.com/';
    public $basePath = 'public/api/';
    public $applicationName = 'lf-user-api';
    
    public $baseUrl2 = 'https://leadferret.com/';
    public $basePath2 = 'public/api'; // for testing specifics with guzzle 
    public $applicationName2 = 'test-api2';
    
    // fill this token when we can so we aren't authenticating all over the place 
    public $activeToken = '';
    

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