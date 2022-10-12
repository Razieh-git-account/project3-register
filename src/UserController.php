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
        $allData = $inputData['datas'];
        $gender = $inputData['gender'];
        $edu = $inputData['education'];
        $image = $inputData['image'];

        $extension = array('jpg','jpeg','png','gif');
        $file_extension = pathinfo($image , PATHINFO_EXTENSION );
        if(!in_array($file_extension , $extension)){
            $_SESSION['status'] = "You are allowed with only jpg , jpeg , png , gif ";
            header("Location: addUser.php");
        }else{
            if(file_exists("images/".$image)){
                $fileName = $image;
                $_SESSION['status'] = "Image already exist".$fileName;
                header("Location: addUser.php");
            }else{
                $sql = "INSERT INTO Users (name, email ,mobile ,password , checkboxData, gender , education ,image) 
                VALUES ('$name','$email','$mobile','$password', '$allData' ,'$gender' , '$edu' , '$image')";
                $result = mysqli_query($this->conn , $sql); 
                if($result){
                    move_uploaded_file($_FILES["image"]["tmp_name"],"images/".$_FILES["image"]["name"]);
                    $_SESSION['status'] = "Image Stored Successfully.";
                    header("Location: index.php");
                }else{
                    $_SESSION['status'] = "Image Not Inserted.";
                    header("Location: addUser.php");
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

    public function update($inputData, $id)
    {
        var_dump($inputData,$id);
        $user_id = mysqli_real_escape_string($this->conn, $id);
        $name = $inputData['name'];
        $email = $inputData['email'];
        $mobile = $inputData['mobile'];
        $password = md5($inputData['password']);
        $new_image = $inputData['new_image'];
        $old_image = $inputData['old_image'];
        $gender = $inputData['gender'];
        $education = $inputData['education'];
        $alldata = $inputData['datas'];
    
        if($new_image != ''){
            $update_fileName = $new_image;
        }else{
            $update_fileName = $old_image;
        }
echo $_FILES["new_image"]["name"] ;
echo "<br>";
echo $_FILES["new_image"]["tmp_name"] ;
echo "<br>";
echo $update_fileName ;
echo "<br>";
echo $old_image;
echo "<br>";
        if(file_exists("images/".$new_image)){
            $fileName=$new_image;
            echo "file is already exist";
            // header("Location: update.php");
        }else{
            $sql = "UPDATE Users SET name='$name', email='$email', mobile='$mobile', password='$password' 
            gender='$gender' , education='$education' , checkboxData='$allData' , image='$update_fileName' WHERE id='$user_id' ";
            $result = $this->conn->query($sql);
            if($result){
                if($_FILES["new_image"]["name"] != ''){
                    move_uploaded_file($_FILES["new_image"]["tmp_name"],"images/".$_FILES["new_image"]["name"]);
                    unlink("images/".$old_image);
                }
                echo "Image  updated";
                // header("Location: index.php");
            }else{
                echo "Image Not updated";
                // header("Location: index.php");
            }
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


    
}

