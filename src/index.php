<?php 
 include('DB/Database.php');
 include_once('UserController.php');

 if(isset($_POST['login'])){
   $email = $_POST['email'];
   $password = $_POST['password'];

   
 }
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('templates/header.php'); ?>
    <div class="container">
        <div class="h4 pb-4 text-center my-5 text-danger border-bottom border-danger">
                Login Form
        </div>
            <form action="searchData.php" method="post" class="border border-dark w-50 " id="users">
                <div class="my-4 ">
                    <label for="email" class="form-label ">Enter your Email address</label>
                    <input type="text"  name="email" class="form-control p-2" >
                </div>
                <div class="my-4 ">
                    <label for="password" class="form-label ">Enter your password</label>
                    <input type="password" class="form-control p-2" >
                </div>
                <div class="my-4">
                    <input type="submit" class="btn btn-info w-50" name="login" value="Login" style="font-size:20px;" >
                </div>
                <div> New User?
                    <a href="addUser.php" class="text-info">SignUp Here</a>
                </div>
            </form>
    </div>
<br><br>
<?php include_once('templates/footer.php'); ?>
</html>

