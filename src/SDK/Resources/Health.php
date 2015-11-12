<?php
namespace LeadFerret\SDK\Resources;


/**
 * Just checks the server
 *
 * @author solvire
 * @package LeadFerret\SDK
 * @name sapce LeadFerret\SDK
 */
class Health extends ResourceClient
{
    /**
     * don't need to log into this one 
     * @var unknown
     */
    protected $requiredAuth = false;
    
    /**
     * 
     * @var unknown
     */
    protected $path = 'health';
    
    public function get()
    {
        $this->response = $this->client->request('GET', $this->path);
        return $this->response;
    }
    
    
    /**
     * can tell if the health endpoint is returning solid data 
     * @return boolean
     */
    public function alive()
    {
        $data = $this->json();
        return $data->status == 'OK';
    }

}
