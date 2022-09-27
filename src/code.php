<?php
include('DB/Database.php');
include('UserController.php');

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
    }
    else
    {
        header("Location: update.php");
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
        header("Location: index.php");
    }
    else
    {
        echo "User can not deleted";

    }
}
?>