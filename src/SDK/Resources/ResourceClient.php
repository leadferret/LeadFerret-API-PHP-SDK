<?php
namespace LeadFerret\SDK\Resources;

use LeadFerret\SDK\LFClient;
use LeadFerret\SDK\Resources\ResourceParameter;

/**
 *
 * @author solvire <stevenjscott@gmail.com>
 * @package Resources
 * @namespace \LeadFerret\SDK\Resources
 */
abstract class ResourceClient extends LFClient
{

    /**
     * this should be set at the sub client level
     * represents a resource location
     * make a trailing slash no leading slash
     *
     * @var unknown
     */
    protected $path = '/';

    /**
     * holder for the json decoded into an object
     *
     * @var mixed $jsonObject
     */
    protected $jsonObject = '';

    /**
     * if authentication is required
     *
     * @var boolean
     */
    protected $requiresAuth = true;

    /**
     *
     * @var array list of parameters
     */
    protected $parameters = [];

    /**
     *
     * @param ResourceParameter $parameter            
     * @return $this
     */
    public function addParameter(ResourceParameter $parameter)
    {
        $this->parameters[$parameter->getKey()] = $parameter;
        return $this;
    }

    /**
     * convert a parameter array into query string
     */
    public function qstring()
    {
        $ret = [];
        if (count($this->parameters) == 0)
            return [];
        
        foreach ($this->parameters as $param) {
            $ret[$param->getKey()] = $param->getValue();
        }
        
        return [
            'query' => $ret
        ];
    }
    
    public function buildHeaders($method, $requiresAuth)
    {
        $headers = [];
        
        if ($requiresAuth)
            $headers += $this->authHeader();
        
        $headers += $this->jsonHeaders();
        
        
        return ['headers' => $headers];
    }

    /*
     * *******************************************************
     * Set up all the main functions that should be available
     * for this client
     *
     * Represents the VERB on the endpoint
     * Blow up if they were not overridden by the client
     *
     * *******************************************************
     */
    public function get()
    {
        try {
            
            // if we are required to auth then try it
            if($this->requiresAuth && !$this->hasToken())
                $this->authenticate();
            
            $headers = $this->buildHeaders('GET',$this->requiresAuth);
            
            $this->response = $this->client->request('GET', 
                $this->path, 
                $this->qstring() + 
                $headers
                );
            
            
        } catch (Exception $e) {
            var_dump($e);
        }
        return $this->response;
    }

    public function post()
    {
        throw new \RuntimeException(__FUNCTION__ . " is not implemented.");
    }

    public function put()
    {
        throw new \RuntimeException(__FUNCTION__ . " is not implemented.");
    }

    public function delete()
    {
        throw new \RuntimeException(__FUNCTION__ . " is not implemented.");
    }

    public function options()
    {
        throw new \RuntimeException(__FUNCTION__ . " is not implemented.");
    }

    /**
     *
     * @return Object
     * @throws \RuntimeException
     */
    public function json()
    {
        if ($this->jsonObject)
            return $this->jsonObject;
        
        if ($this->response) {
            $body = (string) $this->response->getBody();
            $this->jsonObject = json_decode($body);
            
            // if we decoded properly then return the value.
            // the server should never send back null alone
            if ($this->jsonObject !== null)
                return $this->jsonObject;
            
            throw new \RuntimeException("The json string could not be decoded.");
        }
        throw new \RuntimeException("There is no response object to decode");
    }
}