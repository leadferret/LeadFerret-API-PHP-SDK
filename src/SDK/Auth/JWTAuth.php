<?php
namespace LeadFerret\SDK\Auth;


use LeadFerret\SDK\Exceptions\RequestClientException;

/**
 * 
 * @author solvire
 * @package Auth
 * @namesapce LeadFerret\SDK\Auth
 */
class JWTAuth extends MasterAuth
{
    
    protected $username = '';
    protected $password = '';
    protected $tokenEndpoint = '/api-token-auth';
    
    public function authenticate()
    {
        $this->request->appendEndpoint($this->tokenEndpoint)
            ->appendVar('username',$this->username)
            ->appendVar('password',$this->password);
        
        $resp = $this->request->post()->getBody();
        
        
        $data = json_decode($resp,true);
        
        if(!isset($data['token']))
            throw new RequestClientException("The token was missing from the request. " . $resp);
        
        return $data['token'];
    }
    
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    
}
