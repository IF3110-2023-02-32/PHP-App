<?php

abstract class BaseModel {
  public $_primary_key = '';
  protected $_attributes;

  public function __construct() {
    return $this;
  }

  public function set($attribute, $value) {
    $this->$attribute = $value;
    return $this;
  }

  public function get($attribute) {
    return $this->$attribute;
  }
  
  public function constructFromArray($array)
  {
    foreach ($this->_attributes as $attribute) {
      $this->$attribute = $array[$attribute];
    }

    return $this;
  }

  public function toArray()
  {
    $array = [];
    foreach ($this->_attributes as $attribute) {
      $array[$attribute] = $this->$attribute;
    }

    return $array;
  }
}
