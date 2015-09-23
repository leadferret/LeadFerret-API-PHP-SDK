<?php
namespace LeadFerret;

use LeadFerret\Auth\JWTAuth;

/**
 *
 * @author solvire
 * @package LeadFerret
 * @name sapce LeadFerret
 */
class LFClient
{

    const LIBVER = "0.1.0";

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

    private $endpoint = 'http://api.leadferret.com/public/api';

    /**
     * this should probably be removed and placed inside the auth
     * 
     * @var unknown
     */
    private $token = '';
    
    // Used to track authenticated state, can't discover services after doing authenticate()
    private $authenticated = false;

    /**
     * Construct the LeadFerret Client.
     *
     * @param
     *            $options
     */
    public function __construct(array $options = [])
    {
        $this->endpoint = getenv('LF_API_ENDPOINT');
    }

    /**
     * Get a string containing the version of the library.
     *
     * @return string
     */
    public function getLibraryVersion()
    {
        return self::LIBVER;
    }

    /**
     * Attempt to exchange a user/pass for an valid JWT authentication token.
     * If $crossClient is set to true, the request body will not include
     * the request_uri argument
     * Helper wrapped around the OAuth 2.0 implementation.
     *
     * @param string $username            
     * @param string $password            
     * @return string token
     */
    public function authenticate($username = null, $password = null)
    {
        $username = getenv('LF_USERNAME');
        $password = getenv('LF_PASSWORD');
        
        $jwt = new JWTAuth(new Request([
            'endpoint' => $this->endpoint
        ]));
        $this->token = $jwt->setUsername($username)
            ->setPassword($password)
            ->authenticate();
        
        return $this->token;
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
}
    