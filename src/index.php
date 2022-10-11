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
    <div>
        <button  type="button" class="btn btn-primary mt-5 mb-1 text-capitalize" title="برای اضافه کردن کاربر جدید کلیک کنید"> 
            <a href="addUser.php" class="text-light" > Add New User </a>
        </button>
    </div>
    <div class="mt-2 ">
        <button  type="button" class="btn btn-secondary  text-capitalize mb-5" title="برای جستجو کردن آیتم مورد نظر کلیک کنید">
            <a href="search.php" class="text-light " > Search Data..... </a>
        </button>
    </div>
 

    <div class="table-striped">
        <table class="table table-bordered">
        <thead>
            <tr class="text-center">
            <th scope="col">شماره</th>
            <th scope="col">نام کاربری</th>
            <th scope="col">ایمیل</th>
            <th scope="col">موبایل</th>
            <th scope="col">پسورد</th>
            <th scope="col">عکس</th>
            <th scope="col">علاقه مندی</th>
            <th scope="col">ویرایش</th>
            <th scope="col">حذف</th>
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
                    $password = $row['password'];
                    $image = $row['image'];
                    $chechboxData = $row['checkboxData'];
                 echo   
                '<tr>
                    <td class="align-middle">'.$id.'</td>
                    <td class="align-middle">'.$name.'</td>
                    <td class="align-middle">'.$email.'</td>
                    <td class="align-middle">'.$mobile.'</td>
                    <td class="align-middle">'.$password.'</td>
                   
                    <td class="align-middle"> <img src='.$image.' /> </td>
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