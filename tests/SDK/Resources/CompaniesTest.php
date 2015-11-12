<?php
namespace LeadFerret\Tests\SDK\Resources;

use LeadFerret\SDK\Resources\Companies;
use LeadFerret\SDK\Config;
use LeadFerret\SDK\Resources\ResourceParameter;

/**
 *
 * @group Resources
 *
 * @author solvire <stevenjscott@gmail.com>
 * @package Resources
 * @namespace LeadFerret\Tests\SDK\Resources
 */
class CompaniesTest extends \BaseTestCase
{

    public function testCanSearchCompanies()
    {
        $resource = new Companies(new Config($this->getBasicConfigArray01()));
        
        foreach($this->getParameterList() as $key => $value){
            $resource->addParameter(new ResourceParameter($key, $value));
        }
        
        $resource->get();
        echo (string) $resource->getBody();
        
        print_r($resource->json());
    }

    protected function getParameterList()
    {
        return [
            "name" => "IBM%",
            "city" => "Schaumburg",
            "state" => "IL",
            "area_code" => "708"
        ];
        
    }
}