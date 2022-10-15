<?php
session_start();
include('DB/Database.php');
include('UserController.php');
include_once('UserValidator.php');
$errors = [];
if(isset($_POST['update_user']))
{
    // $validation = new UserValidator($_POST);
    // $errors = $validation->validateForm();
    $db = new Database();
   
    // if (count($errors) === 0){
        $inputData = [
            'id' =>  mysqli_real_escape_string($db->conn,$_POST['user_id']),
            'name' => mysqli_real_escape_string($db->conn,$_POST['name']),
            'email' => mysqli_real_escape_string($db->conn,$_POST['email']),
            'mobile' => mysqli_real_escape_string($db->conn,$_POST['mobile']),
            'password' => mysqli_real_escape_string($db->conn,$_POST['password']),
            'datas' => mysqli_real_escape_string($db->conn,implode(",", $_POST['data'])),
            'gender' => mysqli_real_escape_string($db->conn,$_POST['gender']),
            'userType' => mysqli_real_escape_string($db->conn,$_POST['userType']),
            'education' => mysqli_real_escape_string($db->conn,$_POST['education']),
            'new_image' => mysqli_real_escape_string($db->conn,$_FILES['new_image']['name']),
            'old_image' => mysqli_real_escape_string($db->conn,$_POST['old_image']),
            'dob' => mysqli_real_escape_string($db->conn, date('Y-m-d',strtotime($_POST['date-birthday']))),

        ];
     
        $user = new UserController;
        $result = $user->update($inputData);

    
}


if(isset($_POST['deleteUser']))
{
    $db = new Database();
    $id = mysqli_real_escape_string($db->conn, $_POST['delete_id']);
    $delete_image = mysqli_real_escape_string($db->conn, $_POST['delete_image']);
    $sql = "DELETE FROM Users WHERE id='$id' ";
    $result = mysqli_query($db->conn , $sql);
    if($result)
    {
        unlink("images/".$delete_image);
        $_SESSION['status'] = "User Deleted Successfully.";
        header("Location: displayAll.php");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "User Not Deleted .";
        header("Location: displayAll.php");
        exit(0);
    }
}
?>