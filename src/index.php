<?php include_once('Database.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('templates/header.php'); ?>

<div class="container">
    <button  class="btn btn-primary my-5"> <a href="form.php" class="text-light" > Add User </a>
    </button>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">شماره</th>
        <th scope="col">نام کاربری</th>
        <th scope="col">ایمیل</th>
        <th scope="col">پسورد</th>
        <th scope="col">عملیات</th>
        </tr>
    </thead>
    
    <tbody>
    <?php
    $object = new Database();
    $object->readRecords();
    ?>   
   
    </tbody>
    </table>
</div>


<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include_once('templates/footer.php'); ?>

</html>