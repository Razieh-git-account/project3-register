<?php 
  require_once('UserValidatorUpdate.php');
  $errors = [];
  include_once('Database.php');
  if(isset($_GET['updateid'])){
    $id = $_GET['updateid'];
    $object = new Database();
    $con = $object->connect();

    $sql = "SELECT name , email FROM Users WHERE id=$id";
    $result = mysqli_query($con , $sql);
    $row = mysqli_fetch_assoc($result);
    // $Name = $row['name'];
    // $Email = $row['email'];
  }
  if(isset($_POST['update'])){
    // validate entries
    $validation = new UserValidatorUpdate($_POST);
    $errors = $validation->validateForm();

    // if errors is empty --> save data to db
    if (count($errors) === 0){
      $id = $_POST['id'];  
      $name = $_POST['username'];
      $email = $_POST['email'];

      $object->updateRecord($id , $name , $email);
    }
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('templates/header.php'); ?>
<section class="container ">
		<h4 >ویرایش  کاربر</h4>
        <form class="white  z-depth-3" id="users" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"  >
            <input type="hidden" class="input" name="id" value="<?php echo $row['id']; ?>" >
            <input type="text" class="input" name="username" value="<?php echo $row['name']; ?>" placeholder="نام کاربری شما...">
            <div class="red-text"> <?php  echo $errors['username'] ?? '' ?> </div>

            <input type="text" class="input" name="email" value="<?php echo $row['email']; ?>"  placeholder="ایمیل شما...">
            <div class="red-text"> <?php echo $errors['email'] ?? '' ?> </div>

            <div class="center">
                <input type="submit" name="update" value=" ویرایش" class="btn brand z-depth-5">
            </div>
            
        </form>
</section>
<br><br>

<?php include_once('templates/footer.php'); ?>

</html>