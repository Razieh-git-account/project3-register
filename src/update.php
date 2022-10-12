<?php 
session_start();
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
            if(isset($_SESSION['status']) && $_SESSION != '' ){
        ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>   
                </div>
                <button class="btn btn-dark my-3"><a href="index.php" class="text-light">Back</a></button> 
                <?php
                unset($_SESSION['status']);
           } 
        

   
      if(isset($_GET['id']))
      {
          $db = new Database();
          $user_id = mysqli_real_escape_string($db->conn, $_GET['id']);
          $user = new UserController;
          $result = $user->edit($user_id);
          $gender = $result['gender'];
          $edu = $result['education'];
       
          $checkData = explode(",", $result['checkboxData']);
          if($result)
          {
    ?>

        <form id="users" action="code.php" method="POST"  enctype="multipart/form-data" >
            <input type="hidden" name="user_id" value="<?=$result['id']?>">
            <input type="text" class="input" name="name" value="<?=$result['name']?>" >
            <div class="red-text"> <?php  echo $errors['name'] ?? '' ?> </div>

            <input type="text" class="input" name="email" value="<?=$result['email']?>" >
            <div class="red-text"> <?php echo $errors['email'] ?? '' ?> </div>

            <input type="text" class="input" name="mobile" value="<?=$result['mobile']?>" >
            <div class="red-text"> <?php echo $errors['mobile'] ?? '' ?> </div>

            <input type="password" class="input" name="password" value="<?=$result['password']?>">
            <div class="red-text"> <?php echo $errors['password'] ?? '' ?> </div>
            <div class="my-3"> Gender :
                <input type="radio"  name="gender" value="male"
                <?php
                    if($gender == "male"){
                        echo "checked";
                    }
                ?>
                >Male
                <input type="radio"  name="gender" value="female"
                <?php
                    if($gender == "female"){
                        echo "checked";
                    }
                ?>
                >Female
               
                <select name="education" style="margin-left:90px;" >
                    <option value="Select Degree">Select Degree</option>
                    <option value="Primary School"  
                    <?php
                        if($edu =="Primary School" ){
                            echo "selected";
                        }
                    ?>
                    >Primary School</option>
                    <option value="High School"   
                    <?php
                        if($edu =="High School" ){
                            echo "selected";
                        }
                    ?>
                    >High School</option>
                    <option value="Diplom" 
                    <?php
                        if($edu =="Diplom" ){
                            echo "selected";
                        }
                    ?>
                    >Diplom</option>
                    <option value="Bachelor" 
                    <?php
                        if($edu =="Bachelor" ){
                            echo "selected";
                        }
                    ?>
                    >Bachelor</option>
                    <option value="Master" 
                    <?php
                        if($edu =="Master" ){
                            echo "selected";
                        }
                    ?>
                    >Master</option>
                </select>
            </div>

            <div> Favorite Language: 
                <input type="checkbox"  name="data[]" value="Latin"
                <?php
                    if(in_array("Latin", $checkData)){
                        echo "checked";
                    }
                ?>
                > Latin
                <input type="checkbox"  name="data[]" value="Persian"
                <?php
                    if(in_array("Persian", $checkData)){
                        echo "checked";
                    }
                ?>
                > Persian
                <input type="checkbox"  name="data[]" value="Arabic"
                <?php
                    if(in_array("Arabic", $checkData)){
                        echo "checked";
                    }
                ?>
                > Arabic
                <input type="checkbox"  name="data[]" value="Turkey"
                <?php
                    if(in_array("Turkey", $checkData)){
                        echo "checked";
                    }
                ?>
                > Turkey
                <input type="checkbox"  name="data[]" value="Germany"
                <?php
                    if(in_array("Germany", $checkData)){
                        echo "checked";
                    }
                ?>
                > Germany
            </div>
            
            <div class="img my-2">
                <label for="image"> Choose your picture... </label>
                <input type="file" name="new_image" >
                <img src="<?php echo "images/".$result['image']; ?>" width="70px" height="70px" style="margin-left:-60px;">
                <input type="hidden" name="old_image" value="<?php echo $result['image']; ?>">
            </div>
            <div class="text-center">
                <input type="submit" name="update_user" value="Update" class="btn btn-info  ">
                <a href="index.php" class="btn btn-danger  mx-3"> Cancel </a>
            </div>
            
        </form>
        <?php
              }
              else
              {
                  echo "<h4>No Record Found</h4>";
              }
    }
          
          ?>
</section>
<br><br>

<?php include_once('templates/footer.php'); ?>

</html>