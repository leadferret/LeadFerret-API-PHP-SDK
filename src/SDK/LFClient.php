<?php
namespace LeadFerret\SDK;

use LeadFerret\SDK\Auth\JWTAuth;
use Solvire\Application\Environment as Ev;

/**
 * @see https://google-styleguide.googlecode.com/svn/trunk/jsoncstyleguide.xml#Reserved_Property_Names_for_Paging
 * @author solvire
 * @package LeadFerret\SDK
 * @name sapce LeadFerret\SDK
 */
class LFClient
{
    
    /**
     * @var GuzzleHttp/Client
     */
    protected $client = null;
    
    /**
     * @var LFResponse
     */
    protected $response = null;

    /**
     *
     * @var $auth
     */
    private $auth;

    /**
     *
     * @var Config $config
     */
    private $config;

    /**
     *
     * @var Logger $logger
     */
    private $logger;

    /**
     *
     * @var unknown
     */
    private $endpoint = null;

    /**
     * this should probably be removed and placed inside the auth
     *
     * @var unknown
     */
    private $token = '';

    /**
     * Used to track authenticated state,
     * can't discover services after doing authenticate()
     */
    private $authenticated = false;

    /**
     *
     * @var unknown
     */
    protected $headers = [];

    /**
     * Construct the LeadFerret\SDK Client.
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->endpoint = $config->apiUrl();
        if($this->client == null )
            $this->initClient();
    }
    
    protected function initClient()
    {
        $this->client = new \GuzzleHttp\Client(['base_uri' => $this->endpoint]);
    }

    /**
     * Attempt to exchange a user/pass for an valid JWT authentication token.
     * If $crossClient is set to true, the request body will not include
     * the request_uri argument
     * Helper wrapped around the OAuth 2.0 implementation.
     * 
     * TODO need to identify returning calls. 
     * Store the auth token somewhere and check it before trying again. 
     *
     * @param string $username            
     * @param string $password            
     * @return string token
     * @throws RuntimeException
     */
    public function authenticate($username = null, $password = null)
    {
        // will throw a RuntimeException if empty env
        $username = Ev::get('LF_USERNAME');
        $password = Ev::get('LF_PASSWORD');
        
        $jwt = new JWTAuth(new Request([
            'endpoint' => rtrim($this->endpoint,'/')
        ]));
        $this->token = $jwt->setUsername($username)
            ->setPassword($password)
            ->authenticate();
        
        $this->storeToken($this->token);
        return $this->token;
    }
    

    /**
     * get the tokens if they exist  
     * 
     * @return string
     */
    public function gatherToken()
    {
        // first try the environment settings in case someone is running CLI 
        $envToken = Ev::get('LF_JWT_TOKEN');
        
        if($envToken)
            return $envToken;
        
        // then try the file storage in case we just authenticated 
        $tokenStore = Ev::get('LF_TOKEN_STORE');
        $fileToken = file_get_contents($tokenStore);

        if($fileToken)
            return $fileToken;
        
    }
    
    /**
     * 
     * @param string $token
     * @return \LeadFerret\SDK\LFClient
     */
    public function storeToken($token)
    {
        
        // TODO provide a different way (drivers) to store the tokens 
        $tokenStore = Ev::get('LF_TOKEN_STORE');
        
        if(!file_exists(dirname($tokenStore)))
            mkdir(dirname($tokenStore), 0777, true);
        
        // just pump whatever we have into that file 
        file_put_contents($tokenStore, $token);
        
        return $this;
    }
    
    /**
     * @return string token
     */
    public function getToken()
    {
        return $this->token;
    }
    
    public function hasToken()
    {
        return count(explode('.',$this->token)) == 3;
    }

    /**
     *
     * @return MasterAuth implementation
     */
    public function getAuth()
    {
        if (! isset($this->auth)) {
            $class = $this->config->getAuthClass();
            $this->auth = new $class($this);
        }
        return $this->auth;
    }

    /**
     *
     * @return Logger
     */
    public function getLogger()
    {
        if (! isset($this->logger)) {
            $class = $this->config->getLoggerClass();
            $this->logger = new $class($this);
        }
        return $this->logger;
    }

    /**
     *
     * @return string the base URL to use for calls to the APIs
     */
    public function getBasePath()
    {
        return $this->config->getBasePath();
    }

    /**
     *
     * @return string the name of the application
     */
    public function getApplicationName()
    {
        return $this->config->getApplicationName();
    }
    
    public function getResponse()
    {
        return $this->response;
    }
    
    public function getBody()
    {
        if($this->response == null)
            throw new \RuntimeException("There is no response.");
        
        return $this->response->getBody();
    }
    
    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
        return $this;
    }
    

    /**
     * just the default json headers
     *
     * @return string[]
     */
    public function jsonHeaders()
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];
    }
    
    public function authHeader()
    {
        return [
            'Authorization' => 'Bearer ' . $this->token
        ];
    }
    
    public function headers()
    {
        return $this->headers;
    }
    
}
    