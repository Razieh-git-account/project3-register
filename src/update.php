<?php 
  require_once('UserValidatorUpdate.php');
  require_once('UserController.php');
  $errors = [];
  include_once('Database.php');
//   if(isset($_GET['updateid'])){
//     $id = $_GET['updateid'];
//     $object = new Database();
//     $con = $object->connect();

//     $sql = "SELECT name , email FROM Users WHERE id=$id";
//     $result = mysqli_query($con , $sql);
//     $row = mysqli_fetch_assoc($result);
//     // $Name = $row['name'];
//     // $Email = $row['email'];
//   }
//   if(isset($_POST['update'])){
//     // validate entries
//     $validation = new UserValidatorUpdate($_POST);
//     $errors = $validation->validateForm();

//     // if errors is empty --> save data to db
//     if (count($errors) === 0){
//       $id = $_POST['id'];  
//       $name = $_POST['username'];
//       $email = $_POST['email'];

//       $object->updateRecord($id , $name , $email);
//     }
//   }
  
// ?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('templates/header.php'); ?>
<section class="container ">
		<h4 >ویرایش  کاربر</h4>
    <?php
      if(isset($_GET['id']))
      {
          $db = new Database();
          $user_id = mysqli_real_escape_string($db->conn, $_GET['id']);
          $user = new UserController;
          $result = $user->edit($user_id);

          if($result)
          {
              ?>

        <form class="white  z-depth-3" id="users" action="code.php" method="POST"  >
            <input type="hidden" name="user_id" value="<?=$result['id']?>">
            <input type="text" class="input" name="name" value="<?=$result['name']?>" placeholder="نام کاربری شما...">
            <div class="red-text"> <?php  echo $errors['name'] ?? '' ?> </div>

            <input type="text" class="input" name="email" value="<?=$result['email']?>"  placeholder="ایمیل شما...">
            <div class="red-text"> <?php echo $errors['email'] ?? '' ?> </div>

            <input type="text" class="input" name="mobile" value="<?=$result['mobile']?>"  placeholder="موبایل شما...">
            <div class="red-text"> <?php echo $errors['mobile'] ?? '' ?> </div>

            <input type="password" class="input" name="password" value="<?=$result['password']?>"   placeholder=" رمز شما...">
            <div class="red-text"> <?php echo $errors['password'] ?? '' ?> </div>

            <div class="center">
                <input type="submit" name="update_user" value="ویرایش " class="btn brand z-depth-5">
            </div>
            
        </form>
        <?php
              }
              else
              {
                  echo "<h4>No Record Found</h4>";
              }
          }
          else
          {
              echo "<h4>Something Went Wrong</h4>";
          }
          ?>
</section>
<br><br>

<?php include_once('templates/footer.php'); ?>

</html>