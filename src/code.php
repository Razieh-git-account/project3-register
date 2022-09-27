<?php
include('DB/Database.php');
// include_once('UserController.php');
// include_once('UserValidator.php');
// $errors = [];
// if(isset($_POST['save_user']))
// {
//     $validation = new UserValidator($_POST);
//     $errors = $validation->validateForm();
//     $db = new Database();
 
//     if (count($errors) === 0){
//         $inputData = [
//             'name' => mysqli_real_escape_string($db->conn,$_POST['name']),
//             'email' => mysqli_real_escape_string($db->conn,$_POST['email']),
//             'mobile' => mysqli_real_escape_string($db->conn,$_POST['mobile']),
//             'password' => mysqli_real_escape_string($db->conn,$_POST['password']),
            
//         ];
//         $user = new UserController;
//         $result = $user->insertInDatabase($inputData);
        
//         if($result)
//         {
//             header("Location: index.php");
//             exit(0);
//         }
//         else
//         {
//             header("Location: addUser.php");
//             exit(0);
//         }
//     }
// }



if(isset($_POST['update_user']))
{
    $db = new Database();
    $id = mysqli_real_escape_string($db->conn,$_POST['user_id']);
    $inputData = [
        'name' => mysqli_real_escape_string($db->conn,$_POST['name']),
        'email' => mysqli_real_escape_string($db->conn,$_POST['email']),
        'mobile' => mysqli_real_escape_string($db->conn,$_POST['mobile']),
        'password' => mysqli_real_escape_string($db->conn,$_POST['password']),
    ];
    $user = new UserController;
    $result = $user->update($inputData, $id);

    if($result)
    {
        header("Location: index.php");
        exit(0);
    }
    else
    {
        header("Location: update.php");
        exit(0);
    }

}



if(isset($_POST['deleteUser']))
{
    $db = new Database();
    $id = mysqli_real_escape_string($db->conn, $_POST['deleteUser']);
    $user = new UserController;
    $result = $user->delete($id);
    if($result)
    {
        $_SESSION['message'] = "Student Added Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Added";
        header("Location: index.php");
        exit(0);
    }
}
?>