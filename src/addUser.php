<?php 
  include('DB/Database.php');
  include_once('UserController.php');
  include_once('UserValidator.php');
  $errors = [];

  if(isset($_POST['save_user'])){
      $validation = new UserValidator($_POST);
      $errors = $validation->validateForm();
      $db = new Database();
   
      if (count($errors) === 0){
          $inputData = [
              'name' => mysqli_real_escape_string($db->conn,$_POST['name']),
              'email' => mysqli_real_escape_string($db->conn,$_POST['email']),
              'mobile' => mysqli_real_escape_string($db->conn,$_POST['mobile']),
              'password' => mysqli_real_escape_string($db->conn,$_POST['password']),
              'datas' => mysqli_real_escape_string($db->conn,implode(",", $_POST['data'])),
          ];

          $user = new UserController;
          $user->upload_image($inputData);     
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('templates/header.php'); ?>
<div class="container">
		<h4 >اضافه کردن کاربر</h4>
      
        <form  id="users" action="addUser.php" method="POST" enctype="multipart/form-data"  >
            
            <input type="text" class="input" name="name" value="<?php echo htmlspecialchars($_POST['name']) ?? ''; ?>" placeholder="Enter your Name...">
            <div class="text-danger"> <?php  echo $errors['name'] ?? '' ?> </div>

            <input type="text" class="input" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>"  placeholder=" Enter your Email...">
            <div class="text-danger"> <?php echo $errors['email'] ?? '' ?> </div>

            <input type="text" class="input" name="mobile" value="<?php echo htmlspecialchars($_POST['mobile']); ?>"  placeholder="Enter your Mobile Number...">
            <div class="text-danger"> <?php echo $errors['mobile'] ?? '' ?> </div>

            <input type="password" class="input" name="password" value="<?php echo htmlspecialchars($_POST['password']); ?>"   placeholder=" Enter your Password...">
            <div class="text-danger"> <?php echo $errors['password'] ?? '' ?> </div>
           <br>
            <div> Favorite Language: 
                <input type="checkbox"  name="data[]" value="Latin"> Latin
                <input type="checkbox"  name="data[]" value="Persian"> Persian
                <input type="checkbox"  name="data[]" value="Arabic"> Arabic
                <input type="checkbox"  name="data[]" value="Turkey"> Turkey
                <input type="checkbox"  name="data[]" value="Germany"> Germany
            </div>
            <br>
            <div class="img">
                <label for=""> Choose your picture... </label>
                <input type="file" name="image" >
            </div>
            <div class="center">
                <input type="submit" name="save_user" value="Register" class="btn btn-danger my-2 ">
            </div>
            
        </form>
</div>

<br><br>

<?php include_once('templates/footer.php'); ?>

</html>