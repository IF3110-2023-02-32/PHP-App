<?php

require_once SRC_ROOT_PATH . "/app/baseclasses/BaseController.php";

require_once SRC_ROOT_PATH . "app/core/FileAccess.php";
require_once SRC_ROOT_PATH . "/app/modelmanagers/PostManager.php";

class PostController extends BaseController
{
  protected static $instance;

  protected function __construct($srv)
  {
    parent::__construct($srv);
  }

  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      self::$instance = new static(
        PostManager::getInstance()
      );
    }
    return self::$instance;
  }

  protected function post()
  {
    $fileAccess = new FileAccess(FileAccess::POSTS_PATH);
    $newFileName = $fileAccess->saveFileAuto($_FILES['file']['tmp_name']);
    // insert post tweetpost here
  }
}