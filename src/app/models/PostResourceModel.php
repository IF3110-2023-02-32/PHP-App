<?php

require_once SRC_ROOT_PATH . '/app/baseclasses/BaseModel.php';

class PostResourceModel extends BaseModel
{
    public $post_id;
    public $post_owner_id;
    public $body;

    public function __construct()
    {
        $this->_primary_key = ['post_id', 'post_owner_id'];
    }
}
