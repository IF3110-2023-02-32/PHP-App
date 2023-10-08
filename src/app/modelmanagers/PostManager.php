<?php

require_once APP_ROOT_PATH . "/baseclasses/BaseManager.php";

class PostManager extends BaseManager
{
  protected static $instance;
  protected $tableName = 'posts';

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

  public static function getTagsSelection($tags = []) {
    $arrTags = BaseManager::arrToSQLArr($tags);
    $where = ['tags' => ["@>", $arrTags, PDO::PARAM_STR]];
    
    return $where;
  }

  public static function getUserSelection($user_id) {
    $where = ['owner_id' => ['=', $user_id, PDO::PARAM_INT]];

    return $where;
  }

  public function getByUser($user_id)
  {
    $where = PostManager::getUserSelection($user_id);
    return $this->findAll(where:$where);
  }

  public function getReplies($post_id, $owner_id)
  {
    $where = [
      'refer_type' => ['=', 'Reply', PDO::PARAM_STR],
      'refer_post_id' => ['=', $post_id, PDO::PARAM_INT],
      'refer_post_owner' => ['=', $owner_id, PDO::PARAM_INT]
    ];
  }
}