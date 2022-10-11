<?php 
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
    <div class=" text-capitalize my-5">
        <button  type="button" class="btn btn-primary  text-capitalize" title="برای اضافه کردن کاربر جدید کلیک کنید"> 
            <a href="addUser.php" class="text-light" > Add New User </a>
        </button>
    
        <button  type="button" class="btn btn-secondary mx-5 " title="برای جستجو کردن آیتم مورد نظر کلیک کنید">
            <a href="search.php" class="text-light " > Search Data..... </a>
        </button>
    </div>
 
    <div class="h4 pb-4 text-center mb-5 text-danger border-bottom border-danger">
         Show All Users
    </div>
    <div class="table-striped">
        <table class="table table-bordered">
        <thead>
            <tr class="text-center">
            <th scope="col">Id</th>
            <th scope="col">User Name </th>
            <th scope="col">Image</th>
            <th scope="col">Email</th>
            <th scope="col">Mobile</th>
            <th scope="col">Gender</th>
            <th scope="col">Degree</th>
            <th scope="col">Favorite Language </th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            </tr>
        </thead>
        
        <tbody>
        <?php
    $users = new UserController;
    $result = $users->readFromDatabase();
        if($result) {
            foreach($result as $row) {
                ?>
                <?php
                    $id = $row['id'];
                    $name = $row['name'];
                    $email = $row['email'];
                    $mobile = $row['mobile'];
                    $image = $row['image'];
                    $chechboxData = $row['checkboxData'];
                    $gender = $row['gender'];
                    $edu = $row['education'];
                 echo   
                '<tr>
                    <td class="align-middle">'.$id.'</td>
                    <td class="align-middle">'.$name.'</td>
                    <td class="align-middle"> <img src='.$image.' /> </td>
                    <td class="align-middle">'.$email.'</td>
                    <td class="align-middle">'.$mobile.'</td>
                    <td class="align-middle">'.$gender.'</td>
                    <td class="align-middle">'.$edu.'</td>
                    <td class="align-middle">'.$chechboxData.'</td>
                    <td class="align-middle">
                        <a href="update.php?id='.$id.'" class="btn btn-success">Update</a>
                    </td>

                    <td class="align-middle">
                        <form action="code.php" method="POST">
                        <br>
                            <button type="submit" name="deleteUser" value="'.$id.'" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>';
                
            }
        } else {
            echo "No Record Found";
        }
        ?>
        </tbody>
        </table>
    </div>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include_once('templates/footer.php'); ?>

</html>