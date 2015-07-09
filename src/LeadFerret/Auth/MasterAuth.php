<?php
namespace LeadFerret\Auth;

use LeadFerret\Request;
/**
 * 
 * @author solvire
 * @package Auth
 * @namesapce LeadFerret\Auth
 */
abstract class MasterAuth
{
    
    protected $request = null;
    
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
}
