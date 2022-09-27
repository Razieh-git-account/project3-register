<?php

class UserController
{
    public function __construct()
    {
        $db = new Database;
        $this->conn = $db->conn;
    }


    public function readFromDatabase()
    {
        $studentQuery = "SELECT * FROM Users";
        $result = $this->conn->query($studentQuery);
        if($result->num_rows > 0){
            return $result; 
        }else{
            return false;
        }
    }

    public function insertInDatabase($inputData)
    {
        $name = $inputData['name'];
        $email = $inputData['email'];
        $mobile = $inputData['mobile'];
        $password = md5($inputData['password']);

        $sql = "INSERT INTO Users (name,email,mobile,password) VALUES ('$name','$email','$mobile','$password')";
        $result = $this->conn->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function edit($id)
    {
        $user_id = mysqli_real_escape_string($this->conn, $id);
        $sql = "SELECT * FROM Users WHERE id='$user_id' LIMIT 1";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            $data = $result->fetch_assoc();
            return $data;
        }else{
            return false;
        }
    }

    public function update($inputData, $id)
    {
        $user_id = mysqli_real_escape_string($this->conn, $id);
        $name = $inputData['name'];
        $email = $inputData['email'];
        $mobile = $inputData['mobile'];
        $password = md5($inputData['password']);
    

        $sql = "UPDATE Users SET name='$name', email='$email', mobile='$mobile', password='$password' WHERE id='$user_id' LIMIT 1";
        $result = $this->conn->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id)
    {
        $user_id = mysqli_real_escape_string($this->conn,$id);
        $sql = "DELETE FROM Users WHERE id='$user_id' LIMIT 1";
        $result = $this->conn->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }
}
?>