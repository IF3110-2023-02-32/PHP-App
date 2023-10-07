<?php

require_once APP_ROOT_PATH . "/app/exceptions/BadRequestException.php";
require_once APP_ROOT_PATH . "/app/exceptions/MethodNotAllowedException.php";

abstract class BaseController {
  protected static $instance;
  protected $srv;

  protected function __construct($srv) {
    $this->srv = $srv;
  }

  public static function getInstance() {
    if (!isset(self::$instance)) {
      self::$instance = new static(null);
    }
    return self::$instance;
  }

  protected function get($urlParams) {
    throw new MethodNotAllowedException("Method not allowed");  
  }
  protected function post($urlParams) {
    throw new MethodNotAllowedException("Method not allowed");  
  }
  protected function put($urlParams) {
    throw new MethodNotAllowedException("Method not allowed");  
  }
  protected function delete($urlParams) {
    throw new MethodNotAllowedException("Method not allowed");
  }

  /**
   * Handle request, wrapper method
   */
  public function handle($method, $urlParams) {
    $lowMethod = strtolower($method);
    echo $this->$lowMethod($urlParams);
  }
}
