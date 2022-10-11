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

    public function insertInDatabase($inputData , $file)
    {
        $name = $inputData['name'];
        $email = $inputData['email'];
        $mobile = $inputData['mobile'];
        $password = md5($inputData['password']);
        $allData = $inputData['datas'];
        $gender = $inputData['gender'];
        $edu = $inputData['education'];

        $sql = "INSERT INTO Users (name, email ,mobile ,password , checkboxData, gender , education ,image) 
                VALUES ('$name','$email','$mobile','$password', '$allData' ,'$gender' , '$edu' , '$file')";
        $result = mysqli_query($this->conn , $sql);
        
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function edit($id)
    {
        $user_id = mysqli_real_escape_string($this->conn, $id);
        $sql = "SELECT * FROM Users WHERE id='$user_id' ";
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
    

        $sql = "UPDATE Users SET name='$name', email='$email', mobile='$mobile', password='$password' WHERE id='$user_id' ";
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
        $sql = "DELETE FROM Users WHERE id='$user_id' ";
        $result = $this->conn->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function upload_image($inputData){
        $image = $_FILES['image'];
          $imageFileName = $image['name'];
        //   $imageFileError = $image['error'];
          $imageFileTemp = $image['tmp_name'];
          $fileName_seprate = explode('.',$imageFileName);
          $file_extension = strtolower(end($fileName_seprate));
          $extension = array('jpg','jpeg','png');

          if(in_array($file_extension , $extension)){
                $uploade_image = 'images/'.$imageFileName;
                move_uploaded_file($imageFileTemp , $uploade_image);
                $result = $this->insertInDatabase($inputData ,$uploade_image );
                if($result)
                {
                    header("Location: index.php");
                }
                else
                {
                    echo "User can not saved";
                }   
        } 
    }
}

