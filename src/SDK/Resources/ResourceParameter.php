<?php
namespace LeadFerret\SDK\Resources;



/**
 * represents a search parameter
 * should correlate to the parameter we are looking for/by int he database 
 * 
 * @author solvire <stevenjscott@gmail.com>
 * @package API
 * @namespace LeadFerret\SDK\Resources
 */
class ResourceParameter
{
    
    protected $key = '';
    
    protected $value = '';
    
    
    /**
     * 
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
    
    public function getKey()
    {
        return $this->key;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
}
