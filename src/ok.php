<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('templates/header.php'); ?>

<section class="container ">
    
     <h6 >     <?php echo "Your Name is : ".$_SESSION['name']; ?>   </h6>
     <h6 >     <?php echo "Your Email is : ".$_SESSION['email']; ?>         </h6> 
     <h5>    اطلاعات شما با موفقیت در Database  ثبت گردید      </h5>
     <br>
     <div class="center">
          <a href="index.php"  class="btn brand z-depth-5">برگشت به صفححه اصلی   </a>
     </div>
</section>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php include('templates/footer.php'); ?>

</html>