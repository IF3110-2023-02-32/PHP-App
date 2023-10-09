<?php

require_once SRC_ROOT_PATH . "/app/baseclasses/BaseController.php";

require_once SRC_ROOT_PATH . "app/core/FileAccess.php";

require_once SRC_ROOT_PATH . "/app/models/PostModel.php";
require_once SRC_ROOT_PATH . "/app/models/PostResourceModel.php";
require_once SRC_ROOT_PATH . "/app/modelmanagers/PostManager.php";
require_once SRC_ROOT_PATH . "/app/modelmanagers/PostResourceManager.php";

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

  protected function createPost(
    $owner_id,
    $body,
    $refer_type = null,
    $refer_post = null,
    $refer_post_owner = null
    )
  {
    preg_match_all("/(#\w+)/u", $body, $matches);  
    if ($matches) {
        $tagsArray = array_count_values($matches[0]);
        $tags = array_keys($tagsArray);
    }

    $postArr = [
      'owner_id' => $owner_id,
      'body' => $body
    ];

    if(!is_null($refer_type)) {
      $postArr['refer_type'] = $refer_type;
      $postArr['refer_post'] = $refer_post;
      $postArr['refer_post_owner'] = $refer_owner;
    }

    if(isset($tags)) {
      $postArr['tags'] = $tags;
    }

    $postObj = new PostModel();
    $postObj = $postObj->constructFromArray($postArr);

    $attributes = array_intersect_key(PostModel::$PDOATTR, $postArr);
    $post_id = $srv->insert($postObj, $attributes, 'post_id');

    return $post_id;
  }

  protected function insertResources($post_id, $owner_id, $resources)
  {
    $postResourceArr = [
      'post_id' => $post_id,
      'post_owner_id' => $owner_id,
      'path' => null
    ];

    $postResourceSrv = PostResourceManager::getInstance();

    foreach ($resources as $filename) {
      $postResourceArr['path'] = $filename;
      $postResourceObj = new PostResourceManager($postResourceArr);

      
      $attributes = array_intersect_key(PostResourceModel::$PDOATTR, $postArr);
      $postResourceArr->insert($postResourceObj, $attributes);
    }
  }

  public function compose()
  {
    $resources = [];

    if(isset($_FILES['file']['tmp_name'])) {
      $fileAccess = new FileAccess(FileAccess::POSTS_PATH);
      $newFileName = $fileAccess->saveFileAuto($_FILES['file']['tmp_name']);

      $resources[] = $newFileName;
    }

    // insert post tweetpost here
    $user_id = $_SESSION['user_id'];
    $post_id = $this->createPost(
      owner_id: $user_id,
      body: $_POST['body'],
    );

    $this->insertResources(
      $post_id,
      $user_id,
      $resources
    );
  }
}