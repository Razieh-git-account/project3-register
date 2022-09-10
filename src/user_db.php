<?php
include_once 'user_validator.php';
class User_db extends Database {

  protected function save(){

    $user = new UserValidator();
    $name = $user->validateUsername($val);
    $email = $user->validateEmail($val);
    $password = $user->validatePassword($val);

    $sql = " INSERT INTO users (display_name, email, password) VALUES (? , ? , ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param( "sss",$name, $email, md5($password));
    $stmt->execute();
    $stmt->close();
    $connect->close();
  }
}

?>