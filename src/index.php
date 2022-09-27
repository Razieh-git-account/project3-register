<?php 
 include_once('DB/Database.php'); 
 include_once('UserController.php');
 include_once('templates/header.php');
?>
<!DOCTYPE html>
<html lang="en">

<div class="container ">
   <div class="mt-2">
     <button  class="btn btn-primary my-5" title="برای اضافه کردن کاربر جدید کلیک کنید"> <a href="addUser.php" class="text-light" > Add User </a></button>
   </div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead >
            <tr class="center">
            <th scope="col">شماره</th>
            <th scope="col">نام کاربری</th>
            <th scope="col">ایمیل</th>
            <th scope="col">موبایل</th>
            <th scope="col">پسورد</th>
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
                
                <tr>
                    <td scope="col"><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['mobile'] ?></td>
                    <td><?= $row['password'] ?></td>
                    <td>
                        <a href="update.php?id=<?=$row['id'];?>" class="btn btn-success">Update</a>
                    </td>

                    <td>
                        <form action="code.php" method="POST">
                            <button type="submit" name="deleteUser" value="<?= $row['id'] ?>" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php
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