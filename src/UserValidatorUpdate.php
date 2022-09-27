<?php 
include_once 'Database.php';
class UserValidatorUpdate {

  private $data;
  private $errors = [];
  private static $fields = ['username', 'email'];

  public function __construct($post_data){
    $this->data = $post_data;
  }

  public  function validateForm(){

    foreach(self::$fields as $field){
      if(!array_key_exists($field, $this->data)){
        trigger_error("'$field' is not present in the data");
        return;
      }
    }

    $this->validateUsername();
    $this->validateEmail();
    return $this->errors;

  }

  public function validateUsername(){

    $val = trim($this->data['username']);

    if(empty($val)){
      $this->addError('username', 'username cannot be empty');
    } else {
      if(!preg_match("/^[a-zA-Z-' ]*$/", $val)){
        $this->addError('username','username must be chars ');
      }
    }

  }

  public function validateEmail(){

    $val = trim($this->data['email']);

    if(empty($val)){
      $this->addError('email', 'email cannot be empty');
    } else {
      if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
        $this->addError('email', 'email must be a valid email address');
      }
    }

  }

 

  public function addError($key, $val){
    $this->errors[$key] = $val;
  }

}
?>