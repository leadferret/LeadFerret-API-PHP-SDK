<?php
namespace LeadFerret\Tests\SDK;

use GuzzleHttp\Middleware;
use LeadFerret\SDK\Request;

/**
 * 
 * @author solvire
 * @package LeadFerret\SDK
 * @namesapce LeadFerret\SDK
 */
class RequestTest extends \BaseTestCase 
{
    
    public function testCanCreateRequest()
    {
        
        $req = new Request(['endpoint','test.com']);
        $this->assertInstanceOf('\LeadFerret\SDK\Request',$req);
        $this->assertInstanceOf('\GuzzleHttp\Client',$req->getClient());
        
    }
    
    
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

 
    public function appendEndpoint($apiUrl)
    {
        $this->endpoint = $this->endpoint . $apiUrl;
        return $this;
    }

    /**
     *
     * @param Requestable $obj            
     */
    public function appendObject(Requestable $obj)
    {
        $this->outsideVals = array_merge($this->outsideVals, ['json' => $obj->toParam()] );
        
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
        return $this->requestVals;
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
            
            // $response = $this->client->post($this->endpoint, $this->getRequestVars());
            // return new NvpResponse($result);
        try {
            
            // Grab the client's handler instance.
            $clientHandler = $this->client->getConfig('handler');
            // Create a middleware that echoes parts of the request.
            $tapMiddleware = Middleware::tap(function ($request)
            {
                print_r($request->getHeader('Content-Type'));
                // application/json
                echo $request->getBody() . "\n";
                echo $request->getUri() . "\n";
                // {"foo":"bar"}
            });
            
            $response = $this->client->post($this->endpoint, [
                'json' => $this->getRequestVars(),
                'handler' => $tapMiddleware($clientHandler)
            ]);
        } catch (GuzzleHttp\Exception\BadResponseException $e) {
            echo 'Uh oh! ' . $e->getMessage();
        }
        
        
        return $response;
        
        
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