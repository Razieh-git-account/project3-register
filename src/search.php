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
</head>
<body style="background :#ffe0b2;">
    <div class="container">
       <div class="my-5 mt-2">
            <p class="h3 text-center p-2 mb-4">عنوان جستجو را وارد کنید</p>
            <form method="post">
                <input type="text" class="w-75 p-2 mt-4" placeholder="Search data" name="search_item">
                <input type="submit" class="btn btn-dark p-2" name="search" value="Search">
                <button class="btn btn-dark p-2" ><a href="index.php" class="text-white text-decoration-none" role="button"> Back </a></button>
            </form>
       </div>
    </div>

    <div class="container my-5 w-75" >
        <table class="table table-hover align-middle" style="direction:rtl;">
        
        <?php
        if(isset($_POST['search'])){
            $search = $_POST['search_item'];
            $db = new Database;
            $sql = "SELECT * FROM Users WHERE email like '%$search%' OR name like '%$search%' OR mobile like '%$search%'  OR checkboxData like '%$search%'";
            $result = $db->conn->query($sql);
            if($result){
                if(mysqli_num_rows($result)>0){
                    echo
                    '<thead >
                        <tr class="text-center">
                            <th scope="col">شماره</th>
                            <th scope="col">نام کاربری</th>
                            <th scope="col">ایمیل</th>
                            <th scope="col">موبایل</th>
                            <th scope="col">علاقه مندی</th>
                        </tr>
                    </thead>';
                    while($row = mysqli_fetch_assoc($result)){
                        $id = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $mobile = $row['mobile'];
                        $chechboxData = $row['checkboxData'];
                     
                        echo 
                        '<tbody>
                            <tr class="text-center" title="برای مشاهده ی اطلاعات بیشتر روی Id کلیک کنید">
                                <td class="align-middle" >
                                    <a class ="text-danger"  href="searchData.php?data='.$id.'" >'.$id.'</a>
                                </td>
                                <td class="align-middle">'.$name.'</td>
                                <td class="align-middle">'.$email.'</td> 
                                <td class="align-middle">'.$mobile.'</td> 
                                <td class="align-middle">'.$chechboxData.'</td> 
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