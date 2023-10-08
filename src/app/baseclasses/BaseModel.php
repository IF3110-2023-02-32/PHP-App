<?php

abstract class BaseModel {
  public $_primary_key = '';

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
    foreach (array_keys($array) as $attribute) {
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
