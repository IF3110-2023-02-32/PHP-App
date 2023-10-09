<?php

require_once SRC_ROOT_PATH . "/baseclasses/BaseManager.php";

class PostResourceManager extends BaseManager
{
    protected static $instance;
    protected $tableName = 'post_resources';

    protected function __construct()
    {
      parent::__construct();
    }
  
    public static function getInstance()
    {
      if (!isset(self::$instance)) {
        self::$instance = new static();
      }
      return self::$instance;
    }
}