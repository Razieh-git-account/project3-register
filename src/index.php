<?php 

  require_once('user_validator.php');
  require_once('user_db.php');
  $errors = [];

  if(isset($_POST['submit'])){
    // validate entries
    $validation = new UserValidator($_POST);
    $errors = $validation->validateForm();

    // if errors is empty --> save data to db
    if (count($errors) === 0){
    $result = $validation->save($post_data);
     if($result){
      redirect("User Added Successfully","ok.php");
     }
      redirect("User Can't Added","index.php");
    }
    }
  
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('templates/header.php'); ?>
<section class="container ">
		<h4 >اضافه کردن کاربر</h4>
        <form class="white  z-depth-3" id="users" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"  >
            
            <input type="text" class="input" name="username" value="<?php echo htmlspecialchars($_POST['username']) ?? ''; ?>" placeholder="نام کاربری شما...">
            <div class="red-text"> <?php  echo $errors['username'] ?? '' ?> </div>

            <input type="text" class="input" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>"  placeholder="ایمیل شما...">
            <div class="red-text"> <?php echo $errors['email'] ?? '' ?> </div>

            <input type="password" class="input" name="password" value="<?php echo htmlspecialchars($_POST['password']); ?>"  placeholder="رمز شما...">
            <div class="red-text"> <?php echo $errors['password'] ?? '' ?> </div>

            <input type="password" class="input" name="password_conf" value="<?php echo htmlspecialchars($_POST['password_conf']); ?>"   placeholder="تکرار رمز شما...">
            <div class="red-text"> <?php echo $errors['password_conf'] ?? '' ?> </div>

            <div class="center">
                <input type="submit" name="submit" value="ثبت نام" class="btn brand z-depth-5">
            </div>
            
        </form>
</section>
<br><br>

<?php include_once('templates/footer.php'); ?>

</html>