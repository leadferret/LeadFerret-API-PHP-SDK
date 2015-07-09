<?php
namespace LeadFerret\Auth;


use LeadFerret\Request;

/**
 * 
 * @author solvire
 * @package Auth
 * @namesapce LeadFerret\Auth
 */
class JWTAuth extends MasterAuth
{
    
    protected $username = '';
    protected $password = '';
    protected $tokenEndpoint = '';
    
    public function authenticate()
    {
        return $this->request->post(); 
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
