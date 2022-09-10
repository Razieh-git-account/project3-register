<?php 

class UserValidator {

  private $data;
  private $errors = [];
  private static $fields = ['username', 'email' , 'password' , 'password_conf'];

  public function __construct($post_data){
    $this->data = $post_data;
  }

  public function validateForm(){

    foreach(self::$fields as $field){
      if(!array_key_exists($field, $this->data)){
        trigger_error("'$field' is not present in the data");
        return;
      }
    }

    $this->validateUsername();
    $this->validateEmail();
    $this->validatePassword();
    return $this->errors;

  }

  private function validateUsername(){

    $val = trim($this->data['username']);

    if(empty($val)){
      $this->addError('username', 'username cannot be empty');
    } else {
      if(!preg_match('/^[a-zA-Z0-9]$/', $val)){
        $this->addError('username','username must be 6-12 chars & alphanumeric');
      }
    }

  }

  private function validateEmail(){

    $val = trim($this->data['email']);

    if(empty($val)){
      $this->addError('email', 'email cannot be empty');
    } else {
      if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
        $this->addError('email', 'email must be a valid email address');
      }
    }

  }

  private function validatePassword(){

    $val = trim($this->data['password']);

    if(empty($val)){
      $this->addError('password', 'password cannot be empty');
    } else {
      if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,10}$/', $val)){
        $this->addError('password','password must be 6-12 chars & alphanumeric & special chars');
      }
    }

  }

  private function validatePasswordConf(){

    $val = trim($this->data['password_conf']);

    if(empty($val)){
      $this->addError('password_conf', 'password_conf cannot be empty');
    } else {
      if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,10}$/', $val)){
        $this->addError('password_conf','The password_conf must be the same as the password');
      }
    }

  }

  private function addError($key, $val){
    $this->errors[$key] = $val;
  }

}

?>