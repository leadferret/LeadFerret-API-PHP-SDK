<?php
namespace LeadFerret\SDK;


use Solvire\Utilities\OptionsChecker as Ch;

/**
 * 
 * @author solvire <stevenjscott@gmail.com>
 * @package package_name
 * @namespace namespace
 */
class Config 
{
    
    const LIBVER = "0.1.0";
    
    protected $baseUrl = '';
    
    protected $basePath = '';
    
    protected $applicationName = '';
    
    protected $requiredFields = [
        'baseUrl',
        'basePath',
        'applicationName'
    ];
    
    /**
     * 
     */
    public function __construct($options = [])
    {
        Ch::ek($options, $this->requiredFields);
        
        $this->baseUrl = $options['baseUrl'];
        $this->basePath = $options['basePath'];
        $this->applicationName = $options['applicationName'];
        
    }
    
    public function apiUrl()
    {
        return $this->baseUrl . $this->basePath;
    }
    
    /**
     * 
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }
    
    /**
     * 
     * @param string $baseUrl
     * @return \LeadFerret\SDK\Config
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }
 
    /**
     *
     */
    public function getBasePath()
    {
        return $this->basePath;
    }
    
    /**
     *
     * @param string $basePath
     * @return \LeadFerret\SDK\Config
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
        return $this;
    }
    
    /**
     *
     * @return string the name of the application
     */
    public function getApplicationName()
    {
        return $this->applicationName;
    }
    
    /**
     * 
     * @param string $applicationName
     * @return \LeadFerret\SDK\Config
     */
    public function setApplicationName($applicationName)
    {
        $this->applicationName = $applicationName;
        return $this;
    }
    
    /**
     * 
     * @return string[]
     */
    public function getRequiredFields()
    {
        return $this->requiredFields;
    }
    
    /**
     * Get a string containing the version of the library.
     *
     * @return string
     */
    public function getLibraryVersion()
    {
        return self::LIBVER;
    }
    
    
}