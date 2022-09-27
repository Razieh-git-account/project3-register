<?php 
session_start();
include_once 'DB/Database.php';
class UserValidator {

  private $data;
  private $errors = [];
  private static $fields = ['name', 'email' , 'mobile' , 'password'];

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
    $this->validateMobile();
    $this->validatePassword();
    return $this->errors;

  }

  public function validateUsername(){

    $val = trim($this->data['name']);

    if(empty($val)){
      $this->addError('name', 'اسم نباید خالی باشد');
    } else {
      if(!preg_match("/^[a-zA-Z-' ]*$/", $val)){
        $this->addError('name','اسم فقط شامل حروف است ');
      }
    }

  }

  public function validateEmail(){

    $val = trim($this->data['email']);

    if(empty($val)){
      $this->addError('email', 'ایمیل نباید خالی باشد');
    } else {
      if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
        $this->addError('email', 'ایمیل  نامعتبر است');
      }
    }

  }

  public function validateMobile(){

    $val = trim($this->data['mobile']);

    if(empty($val)){
      $this->addError('mobile', 'موبایل نباید خالی باشد');
    } else {
      if(!preg_match("/^[0-9' ]*$/", $val)){
        $this->addError('mobile','موبایل را بصورت عدد وارد کنید');
      }
    }

  }

  public function validatePassword(){

    $val = trim($this->data['password']);

    if(empty($val)){
      $this->addError('password', 'رمز نباید خالی باشد');
    } else {
      if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,10}$/', $val)){
        $this->addError('password','رمز عبور باید ترکیبی از اعداد و حروف و بین 6 تا 10 کاراکتر باشد');
      }
    }

  }

  public function addError($key, $val){
    $this->errors[$key] = $val;
  }

}
?>