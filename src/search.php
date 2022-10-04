<?php 
include_once('UserController.php');
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
</head>
<body style="background :#ffe0b2;">
    <div class="container ">
       <div class="my-5 mt-2">
            <p class="h3 text-center p-2 mb-4">عنوان جستجو را وارد کنید</p>
            <form method="post">
                <input type="text" class="form-control" placeholder="Search data" name="search">
                <button class="btn btn-dark mt-3 p-2" name="submit">Search Data</button>
            </form>
       </div>
    </div>

    <div class="container my-5" >
        <table class="table table-hover align-middle" style="direction:rtl;">
        
        <?php
        if(isset($_POST['submit'])){
            $search = $_POST['search'];
            $db = new Database;
            $sql = "SELECT * FROM Users WHERE email like '%$search%' or name like '%$search%' or mobile like '%$search%' ";
            $result = $db->conn->query($sql);
            if($result){
                if(mysqli_num_rows($result)>0){
                    echo '<thead >
                    <tr class="text-center">
                        <th scope="col">شماره</th>
                        <th scope="col">نام کاربری</th>
                        <th scope="col">ایمیل</th>
                    </tr>
                    </thead>';
                    while($row = mysqli_fetch_assoc($result)){
                        $id = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                     
                        echo '<tbody>
                        <tr class="text-center">
                            <td class="align-middle"><a href="searchData.php?data='.$id.'" >'.$id.'</a></td>
                            <td class="align-middle">'.$name.'</td>
                            <td class="align-middle">'.$email.'</td> 
                        </tr>
                        </tbody>';
                    }
                }
                else{
                    echo "<h2 class=text-danger> Data not found </h2>";
                }
             
            }

        }
     
            
        ?>
        </table>
    </div>
</body>
</html>