<?php
namespace LeadFerret\SDK\Resources;


/**
 * Just checks the server
 *
 * @author solvire
 * @package LeadFerret\SDK
 * @name sapce LeadFerret\SDK
 */
class Companies extends ResourceClient
{
    
    /**
     * 
     * @var unknown
     */
    protected $path = 'companies';
    
    /**
     * 
     * {@inheritDoc}
     * @see \LeadFerret\SDK\Resources\ResourceClient::get()
     */
    public function get()
    {
        if(count($this->parameters) == 0)
            throw new \RuntimeException("There must be parameters provided in this call.");
        
        $this->response = parent::get();
        return $this->response;
    }

}
