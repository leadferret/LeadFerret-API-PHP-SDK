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
   * @var $auth
   */
  private $auth;


  /**
   * @var Config $config
   */
  private $config;

  /**
   * @var Logger $logger
   */
  private $logger;

  // Used to track authenticated state, can't discover services after doing authenticate()
  private $authenticated = false;

  /**
   * Construct the LeadFerret Client.
   *
   * @param $options
   */
  public function __construct(array $options = [])
  {
      
      

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
  public function authenticate($username, $password)
  {
    
      $jwt = new JWTAuth(new Request());
      $jwt->setUsername($username)
        ->setPassword($password)
        ->authenticate();
      
      
      
  }
  

  /**
   * @return MasterAuth implementation
   */
  public function getAuth()
  {
    if (!isset($this->auth)) {
      $class = $this->config->getAuthClass();
      $this->auth = new $class($this);
    }
    return $this->auth;
  }

  /**
   * @return Logger
   */
  public function getLogger()
  {
    if (!isset($this->logger)) {
      $class = $this->config->getLoggerClass();
      $this->logger = new $class($this);
    }
    return $this->logger;
  }

  /**
   * @return string the base URL to use for calls to the APIs
   */
  public function getBasePath()
  {
    return $this->config->getBasePath();
  }

  /**
   * @return string the name of the application
   */
  public function getApplicationName()
  {
    return $this->config->getApplicationName();
  }

}
    