<?php
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
    $id = mysqli_real_escape_string($db->conn, $_POST['deleteUser']);
    $user = new UserController;
    $result = $user->delete($id);
    if($result)
    {
        header("Location: index.php");
    }
    else
    {
        echo "User can not deleted";

    }
}
?>