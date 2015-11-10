<?php
namespace LeadFerret\SDK\Auth;

use LeadFerret\SDK\Request;
/**
 * 
 * @author solvire
 * @package Auth
 * @namesapce LeadFerret\SDK\Auth
 */
abstract class MasterAuth
{
    
    protected $request = null;
    
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
}
