<?php 
    include_once('DB/Database.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        img{
            width: 100px;
            height:100px;
        }
    </style>
<body style="background :#ffe0b2;">
    <?php
        $data = $_GET['data'];
        $db = new Database;
        $sql = "SELECT * FROM Users WHERE id= '$data' ";
        $result = $db->conn->query($sql);
        if($result){
            $row = mysqli_fetch_assoc($result);
            $image = $row['image'];
            echo 
            '<div class="container my-5">
                <div class="jumbotron ">
                    <h1 class="display-4  text-center text-success mb-4">'.$row['name'].'</h1>
                    <p class=" text-primary  text-center"> Your image is...   <img src=images/'.$image.' class="rounded-3" /> </p>
                    <p class="text-danger text-center"> Your email is : '.$row['email'].'</p>
                    <p class="text-dark text-center"> Your mobile is : '.$row['mobile'].'</p>
                    <p class="text-secondary text-center"> Your password is : '.$row['password'].'</p>
                    <p class="text-success text-center"> Your birthday is : '.$row['dob'].'</p>
                    <p class="text-danger text-center"> Your Favorrite Languages are : '.$row['checkboxData'].'</p>
                    <p class="text-dark text-center"> Your Gender is : '.$row['gender'].'</p>
                    <p class="text-info text-center"> Your Degree is : '.$row['education'].'</p>
                    <hr class="my-4">
                    <p class="lead"><a class="btn btn-dark btn-lg text-white text-decoration-none" href="search.php" role="button"> Back </a> </p>
                </div>
            </div>';
        }
    ?>
</body>
</html>