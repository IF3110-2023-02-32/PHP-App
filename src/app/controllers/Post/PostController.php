<?php

require_once SRC_ROOT_PATH . "/app/baseclasses/BaseController.php";

require_once SRC_ROOT_PATH . "/app/core/FileAccess.php";

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
      $tagsSQL = BaseManager::arrToSQLArr($tags);
      $postArr['tags'] = $tagsSQL;
    }

    $postObj = new PostModel();
    $postObj = $postObj->constructFromArray($postArr);

    $attributes = array_intersect_key(PostModel::$PDOATTR, $postArr);

    $post_id = $this->srv->insert($postObj, $attributes, 'post_id');
    $post_id = $post_id[0]['post_id'];

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
      $postResourceObj = new PostResourceModel($postResourceArr);

      $attributes = array_intersect_key(PostResourceModel::$PDOATTR, $postResourceArr);
      $postResourceSrv->insert($postResourceObj, $attributes);
    }
  }

  protected function compose()
  {
    // insert post tweetpost here
    $user_id = $_SESSION['user_id'];
    $post_id = $this->createPost(
      owner_id: $user_id,
      body: $_POST['post_body'],
    );

    $resources = [];

    // var_dump($_FILES);
    if(isset($_FILES['file_input']['tmp_name'])) {
      $fileAccess = FileAccess::getInstance();
      $newFileName = $fileAccess->saveFile($_FILES['file_input']['tmp_name'], FileAccess::POSTS_PATH, $_FILES['file_input']['type']);

      $resources[] = $newFileName;
    }

    $this->insertResources(
      $post_id,
      $user_id,
      $resources
    );
  }

  protected function post($urlParams)
  {
    $this->compose();
    require PAGE_PATH . "/submission.php";
    exit();
  }
}