<?php
include_once 'user_validator.php';
include_once 'db.php';
include_once 'index.php';

class User_db  {

  public function __construct(){
    $db = new Database();
    $this->$conn = $db->$conn;
  }
  
}
?>