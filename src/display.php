<?php 
session_start();
 include_once('DB/Database.php'); 
 include_once('UserController.php');
 include_once('templates/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<style>
    img{
        width: 70px;
        height:70px;
    }
</style>
<div class="container ">
    <?php
        include_once('message.php');
    ?>
    <div class="h4 pb-4 text-center my-3 text-danger border-bottom border-danger">
         Show Users Logged In
    </div>
        <?php
            $db = new Database();
            $user = new UserController;
            $result = $user->readOnceUserFromDatabase($_SESSION['email'],$_SESSION['password']);
            $id = $result['id'];
            if($result){
                    echo 
                    '<div class="container">
                        <div class="jumbotron ">
                            <h1 class="display-5  text-center text-success mb-2">'.$result['name'].'</h1>
                            <p class=" text-primary  text-center"> Your image is...   <img src=images/'.$result['image'].' class="rounded-3" /> </p>
                            <p class="text-danger text-center"> Your email is : '.$result['email'].'</p>
                            <p class="text-dark text-center"> Your mobile is : '.$result['mobile'].'</p>
                            <p class="text-secondary text-center"> Your password is : '.$result['password'].'</p>
                            <p class="text-success text-center"> Your birthday is : '.$result['dob'].'</p>
                            <p class="text-danger text-center"> Your Favorrite Languages are : '.$result['checkboxData'].'</p>
                            <p class="text-dark text-center"> Your Gender is : '.$result['gender'].'</p>
                            <p class="text-info text-center"> Your Degree is : '.$result['education'].'</p>
                            <hr class="my-2">
                            <p class="lead text-center mt-5">
                                <a class="btn btn-success btn-lg text-white text-decoration-none w-25" href="update.php?id='.$id.'" role="button"> Edit </a> 
                                <a class="btn btn-danger btn-lg text-white text-decoration-none w-25 mx-5" href="index.php" role="button"> Logout </a> 
                            </p>
                        </div>
                    </div>';
        } else {
            echo "No Record Found";
        }
  
        ?>
        </tbody>
        </table>
    </div>

    <!-- <div class=" text-capitalize my-5">
        <button  type="button" class="btn btn-dark " >
            <a href="index.php" class="text-light " > Logout Form..... </a>
        </button>
    </div> -->
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include_once('templates/footer.php'); ?>

</html>