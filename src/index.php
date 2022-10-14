<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('templates/header.php'); ?>
    <div class="container">
        <div class="h4 pb-4 text-center my-5 text-danger border-bottom border-danger">
                Login Form
        </div>
        <?php
            if(isset( $_SESSION['status']) && $_SESSION != '' ){
        ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>           
                </div>
                <?php
                unset($_SESSION['status']);
           } 
           ?>
            <form action="display.php" method="POST" class="border border-dark w-50 " id="users" autocomplete="off">
                <div class="my-4 ">
                    <label for="email" class="form-label ">Enter your Email address</label>
                    <input type="text"  name="email" class="form-control p-2" value="<?php echo htmlspecialchars($_POST['email']) ?? ''; ?>" >
                </div>
                <div class="my-4 ">
                    <label for="password" class="form-label ">Enter your password</label>
                    <input type="text" class="form-control p-2" name="password" value="<?php echo htmlspecialchars($_POST['password']); ?>"  >
                </div>
                <div class="my-4">
                    <input type="submit" class="btn btn-info w-50" name="login" value="Login" style="font-size:20px;" >
                </div>
                <div class="my-4">Do You Want To Create New User?
                    <a href="addUser.php" class="text-info">SignUp Here</a>
                </div>
            </form>
    </div>
<br><br>
<?php include_once('templates/footer.php'); ?>
</html>

