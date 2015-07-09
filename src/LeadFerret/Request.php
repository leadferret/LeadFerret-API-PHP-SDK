<?php
namespace LeadFerret;


/**
 * 
 * @author solvire
 * @package LeadFerret
 * @namesapce LeadFerret
 */
class Request 
{
    
    /**
     * guzzle client
     * 
     * @var unknown
     */
    protected $client = null;

    protected $endpoint = null;

    protected $transactionType = null;

    protected $tender = null;

    protected $action = null;

    protected $payment = null;

    /**
     * Auth object holds user/password stuff
     * 
     * @var unknown
     */
    protected $authentication = null;

    protected $requestVals = [];

    protected $outsideVals = [];

 
    public function __construct($options)
    {
        
        $this->endpoint = $options['endpoint'];
    }

    /**
     *
     * @param Requestable $obj            
     */
    public function appendObject(Requestable $obj)
    {
        $this->outsideVals = array_merge($this->outsideVals, $obj->toParam());
        return $this;
    }

    public function appendVar($key, $val)
    {
        $this->requestVals[$key] = $val;
        return $this;
    }

    /**
     * remaps the values
     * 
     * @return multitype:multitype:
     */
    public function getRequestVars()
    {
        $nvp = [];
        // loop each of the keys we might have and see if there is any data
        // if we have some data then stack up the variable for the NVP
        foreach ($this->requestMap as $key => $val) {
            // if it is set use it
            if (isset($this->requestVals[$val]))
                $nvp[$key] = $this->requestVals[$val];
        }
        
        $authVars = $this->authentication->toParam();
        
        return $nvp + $this->outsideVals + $authVars;
    }

    /**
     *
     * @param Authentication $authentication            
     */
    public function setAuthentication(Authentication $authentication)
    {
        $this->authentication = $authentication;
        return $this;
    }

    /**
     *
     * @return \Illuminate\Routing\Route
     */
    public function post()
    {
        $vars = $this->getRequestVars();
        $paramList = array();
        foreach ($vars as $index => $value) {
            if ($value === '' or $value === null)
                continue;
            $paramList[] = $index . "=" . $value;
        }
        
        $apiStr = implode("&", $paramList);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $apiStr);
        $result = curl_exec($curl);
        
        if ($result === FALSE) {
            throw new \RuntimeException(curl_error($curl));
        }
        curl_close($curl);
        
        return new NvpResponse($result);
    }

    /**
     * 
     * @param unknown $type
     * @return \LF\Services\PayPal\NvpRequest
     */
    public function setTransactionType($type)
    {
        $this->transactionType = $type;
        return $this;
    }

    /**
     * 
     * @param unknown $tenderType
     * @return \LF\Services\PayPal\NvpRequest
     */
    public function setTenderType($tenderType)
    {
        $this->tenderType = $tenderType;
        return $this;
    }

    /**
     * 
     * @param unknown $action
     * @return \LF\Services\PayPal\NvpRequest
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * 
     * @param unknown $returnUrl
     * @return \LF\Services\PayPal\NvpRequest
     */
    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
        return $this;
    }

    /**
     * 
     * @param unknown $cancelUrl
     * @return \LF\Services\PayPal\NvpRequest
     */
    public function setCancelUrl($cancelUrl)
    {
        $this->cancelUrl = $cancelUrl;
        return $this;
    }

    /**
     * 
     * @param Payment $payment
     * @return \LF\Services\PayPal\NvpRequest
     */
    public function setPayment(Payment $payment)
    {
        $this->payment = $payment;
        return $this;
    }
}