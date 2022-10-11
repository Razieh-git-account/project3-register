<?php 
  require_once('UserController.php');
  include_once('DB/Database.php');
 ?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('templates/header.php'); ?>
<section class="container ">
    <div class="h4 pb-4 text-center my-5 text-danger border-bottom border-danger">
            Edit Exist User
    </div>
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
            <input type="text" class="input" name="name" value="<?=$result['name']?>" >
            <div class="red-text"> <?php  echo $errors['name'] ?? '' ?> </div>

            <input type="text" class="input" name="email" value="<?=$result['email']?>" >
            <div class="red-text"> <?php echo $errors['email'] ?? '' ?> </div>

            <input type="text" class="input" name="mobile" value="<?=$result['mobile']?>" >
            <div class="red-text"> <?php echo $errors['mobile'] ?? '' ?> </div>

            <input type="password" class="input" name="password" value="<?=$result['password']?>">
            <div class="red-text"> <?php echo $errors['password'] ?? '' ?> </div>
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
                <input type="submit" name="update_user" value="Update" class="btn btn-info my-2 ">
                <a href="index.php" class="btn btn-danger my-2 mx-3"> Cancel </a>
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