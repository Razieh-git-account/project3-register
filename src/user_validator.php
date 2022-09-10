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
    return $this->save();

  }

  public function validateUsername(){

    $val = trim($this->data['username']);

    if(empty($val)){
      $this->addError('username', 'username cannot be empty');
    } else {
      if(!preg_match("/^[a-zA-Z-' ]*$/", $val)){
        $this->addError('username','username must be 6-12 chars & alphanumeric');
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

  public function validatePassword(){

    $val = trim($this->data['password']);

    if(empty($val)){
      $this->addError('password', 'password cannot be empty');
    } else {
      if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,10}$/', $val)){
        $this->addError('password','password must be 6-12 chars & alphanumeric & special chars');
      }
    }

  }

  public function validatePasswordConf(){

    $val = trim($this->data['password_conf']);

    if(empty($val)){
      $this->addError('password_conf', 'password_conf cannot be empty');
    } else {
      if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,10}$/', $val)){
        $this->addError('password_conf','The password_conf must be the same as the password');
      }
    }

  }

  public function addError($key, $val){
    $this->errors[$key] = $val;
  }


  public function save($post_data){
    include_once 'db.php';
    $db = new Database();
    $this->$conn = $db->$conn;
    // $user = new UserValidator($post_data);
    // $name = $user->validateUsername($val);
    // $email = $user->validateEmail($val);
    // $password = $user->validatePassword($val);
    $name = mysqli_real_escape_string($this->$conn , $this->data['username']);
    $email = mysqli_real_escape_string($this->$connn , $this->data['email']);
    $password = mysqli_real_escape_string($this->$conn , $this->data['password']);

    $sql = $db->$conn->query(" INSERT INTO users(name, email, password) VALUES (? , ? , ?)");
    $stmt = mysqli_smt_init($db->$conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      echo "SQL Error";
    }else{
      mysqli_stmt_bind_param($stmt, "sss",$name, $email, md5($password));
    }
      header("Location: ok.php");
  }

}

?>