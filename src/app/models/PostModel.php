<?php

require_once APP_ROOT_PATH . '/app/baseclasses/BaseModel.php';

class PostModel
{
    public $post_id;
    public $owner_id;
    public $body;
    public $created_at;
    // public $refer_type;
    // public $refer_post;
    // public $refer_post_owner;
    public $tags;

    private function __construct()
    {
        $this->_attributes = ['post_id', 'owner_id', 'body', 'created_at', 'tags'];
        $this->_primary_key = ['post_id', 'owner_id'];
    }
}
