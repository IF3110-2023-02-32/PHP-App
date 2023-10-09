<?php

require_once SRC_ROOT_PATH . '/app/baseclasses/BaseModel.php';

class PostModel extends BaseModel
{
    public $post_id;
    public $owner_id;
    public $body;
    public $created_at;

    public $refer_type = null;
    public $refer_post = null;
    public $refer_post_owner = null;

    public $tags = [];

    public function __construct()
    {
        $this->_primary_key = ['post_id', 'owner_id'];
    }
}
