<?php
include_once 'user_validator.php';
include_once 'db.php';

class User_db extends Database {

  public function save(){

    $user = new UserValidator($post_data);
    $name = $user->validateUsername($val);
    $email = $user->validateEmail($val);
    $password = $user->validatePassword($val);

    $sql = " INSERT INTO $this->users (name, email, password) VALUES (? , ? , ?)";
    $stmt = $this->$conn->prepare($sql);
    $stmt->bind_param( "sss",$name, $email, md5($password));
    $stmt->execute();
    $stmt->close();
    $connect->close();
    header('Location:ok.php');
  }
}

?>