<?php 
session_start();
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
              'gender' => mysqli_real_escape_string($db->conn,$_POST['gender']),
              'education' => mysqli_real_escape_string($db->conn,$_POST['education']),
              'image' => mysqli_real_escape_string($db->conn,$_FILES['image']['name']),
              'dob' => mysqli_real_escape_string($db->conn, date('Y-m-d',strtotime($_POST['date-birthday']))),
          ];

          $user = new UserController;
          $user->insertInDatabase($inputData);     
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('templates/header.php'); ?>
<section class="container">
    <div class="h4 pb-4 text-center my-5 text-danger border-bottom border-danger">
            Add New User
    </div>
        <?php
            include_once('message.php');
        ?>
               
        <form  id="users" action="addUser.php" method="POST" enctype="multipart/form-data"  >
            
            <input type="text" class="input" name="name" value="<?php echo htmlspecialchars($_POST['name']) ?? ''; ?>" placeholder="Enter your Name...">
            <div class="text-danger"> <?php  echo $errors['name'] ?? '' ?> </div>

            <input type="text" class="input" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>"  placeholder=" Enter your Email...">
            <div class="text-danger"> <?php echo $errors['email'] ?? '' ?> </div>

            <input type="text" class="input" name="mobile" value="<?php echo htmlspecialchars($_POST['mobile']); ?>"  placeholder="Enter your Mobile Number...">
            <div class="text-danger"> <?php echo $errors['mobile'] ?? '' ?> </div>

            <input type="password" class="input" name="password" value="<?php echo htmlspecialchars($_POST['password']); ?>"   placeholder=" Enter your Password...">
            <div class="text-danger"> <?php echo $errors['password'] ?? '' ?> </div>
            <div > Date of Birthday :
                <input type="date" name="date-birthday" style="width:373px; padding:6px; margin:5px 0 3px 0;">
            </div>
           
            <div class="my-2" > Gender :
                <input type="radio"  name="gender" value="male" >Male
                <input type="radio"  name="gender" value="female" >Female

                <select name="education" style="margin-left:10px; width:310px; padding:6px;" >
                    <option value="Select Degree">Select Degree</option>
                    <option value="Primary School">Primary School</option>
                    <option value="High School">High School</option>
                    <option value="Diplom">Diplom</option>
                    <option value="Bachelor">Bachelor</option>
                    <option value="Master">Master</option>
                </select>
            </div>
            <div class="my-3"> Favorite Language: 
                <input type="checkbox"  name="data[]" value="Latin"> Latin
                <input type="checkbox"  name="data[]" value="Persian"> Persian
                <input type="checkbox"  name="data[]" value="Arabic"> Arabic
                <input type="checkbox"  name="data[]" value="Turkey"> Turkey
                <input type="checkbox"  name="data[]" value="Germany"> Germany
            </div>
            
            <div class="img">
                <label for=""> Choose your picture... </label>
                <input type="file" name="image" >
            </div>
            <div class="center">
                <input type="submit" name="save_user" value="Register" class="btn btn-success my-2 ">
                <a href="display.php" class="btn btn-danger my-2 mx-3"> Cancel </a>
            </div>
            
        </form>
</section>

<br><br>

<?php include_once('templates/footer.php'); ?>

</html>