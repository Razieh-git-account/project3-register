<?php
session_start();
class UserController
{
    public function __construct()
    {
        $db = new Database;
        $this->conn = $db->conn;
    }


    public function readFromDatabase()
    {
        $studentQuery = "SELECT * FROM Users WHERE userType='user'";
        $result = $this->conn->query($studentQuery);
        if($result->num_rows > 0){
            return $result; 
        }else{
            return false;
        }
    }

    public function readOnceUserFromDatabase($email , $password)
    {
        $sql = "SELECT * FROM Users WHERE email ='$email' AND password ='$password' ";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            $data = $result->fetch_assoc();
            return $data;
        }else{
            return false;
        }
    }
    public function insertInDatabase($inputData)
    {
        $name = $inputData['name'];
        $email = $inputData['email'];
        $mobile = $inputData['mobile'];
        $password = $inputData['password'];
        $allData = $inputData['datas'];
        $gender = $inputData['gender'];
        $edu = $inputData['education'];
        $dob = $inputData['dob'];
        $image = $inputData['image'];
        $user = 'user';

        $fileName = $_FILES["image"]["name"];
        $extension = array('jpg','jpeg','png','gif');
        $file_extension = pathinfo($image , PATHINFO_EXTENSION );
        if(!in_array($file_extension , $extension)){
            $_SESSION['status'] = "You are allowed with only jpg , jpeg , png , gif ";
            header("Location: addUser.php");
            exit(0);
        }else{
            if(file_exists("images/".$image)){
                $_SESSION['status'] = "Image already exist.";
                header("Location: addUser.php");
                exit(0);
            }else{
                $sql = "INSERT INTO `Users` (name,email,mobile,password,dob,checkboxData,gender,education,image,userType) 
                VALUES ('$name','$email','$mobile','$password','$dob','$allData','$gender','$edu','$image','$user')";
                $result = mysqli_query($this->conn , $sql); 
                if($result){
                    move_uploaded_file($_FILES["image"]["tmp_name"],"images/".$_FILES["image"]["name"]);
                    $_SESSION['status'] =  "Datas Stored Successfully.";
                    header("Location: index.php");
                    exit(0);
                }else{
                    $_SESSION['status'] = "Datas Not Inserted.";
                    header("Location: addUser.php");
                    exit(0);
                }
            }
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

    public function update($inputData)
    {
        $user_id = $inputData['id'];
        $name = $inputData['name'];
        $email = $inputData['email'];
        $mobile = $inputData['mobile'];
        $password = $inputData['password'];
        $new_image = $inputData['new_image'];
        $old_image = $inputData['old_image'];
        $gender = $inputData['gender'];
        $userType = $inputData['userType'];
        $education = $inputData['education'];
        $allData = $inputData['datas'];
        $dob = $inputData['dob'];
       
        if($new_image != ''){
            $update_fileName = $new_image;
        }else{
            $update_fileName = $old_image;
        }
     
            if(file_exists("images/".$new_image)){
                $fileName=$new_image;
                $_SESSION['status'] = "Image ( ".$fileName." ) already exist ";
                header("Location: update.php");
                exit(0);
            }else{
                $sql = "UPDATE `Users` SET name='$name', email='$email', mobile='$mobile', password='$password' , dob='$dob'
                , checkboxData='$allData' ,  gender='$gender' , education='$education', image='$update_fileName' WHERE id='$user_id' ";
                $result = $this->conn->query($sql);
                if($result){
                    if($_FILES["new_image"]["name"] != ''){
                        move_uploaded_file($_FILES["new_image"]["tmp_name"], "images/".$_FILES["new_image"]["name"]);
                        unlink("images/".$old_image);
                    }
                    
                    $_SESSION['status'] = "Data Updated.";
                    header("Location: display.php");
                    exit(0);
                }else{
                    $_SESSION['status'] = "Data Not Updated.";
                    header("Location: update.php");
                    exit(0);
                }
            }
  }
        
    

   /* public function delete($id)
    {
        $user_id = mysqli_real_escape_string($this->conn,$id);
        $sql = "DELETE FROM Users WHERE id='$user_id' ";
        $result = $this->conn->query($sql);
        if($result){
       
            return true;
        }else{
            return false;
        }
    }*/
    
    public function login($inputData)
    {
        $email = $inputData['email'];
        $password = $inputData['password'];
        $sql = "SELECT * FROM `Users` WHERE email ='$email' AND password ='$password' ";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            $data = $result->fetch_assoc();
            return $data;
        }else{
            return false;
        }
            
    }


    
}

