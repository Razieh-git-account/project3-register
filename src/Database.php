<?php

class Database {

  public $DB_HOST = "mysql-DB"  ;
  public $DB_USER = "root" ;
  public $DB_PASS = "1234" ;
  public $DB_NAME = "My_db" ;
  public $TABLE_NAME = "Users" ;



  public function connect(){
   
    $conn = mysqli_connect($this->DB_HOST , $this->DB_USER , $this->DB_PASS , $this->DB_NAME);
    return $conn;
  }

  public function saveRecord($n , $e , $p){
    $con = $this->connect();
    mysqli_query($con , "INSERT INTO ".$this->TABLE_NAME."(name , email, password) VALUES ('$n' , '$e' , '$p')") 
    or die(mysqli_error($con));
    header('Location: ok.php');
  }

  public function readRecords(){
    $con = $this->connect();
    $sql = "SELECT * FROM ".$this->TABLE_NAME."";
    $result = mysqli_query($con , $sql);
    if($result){
      while($row = mysqli_fetch_assoc($result)){
         $id = $row['id'];
         $name = $row['name'];
         $email = $row['email'];
         $password = $row['password'];
         echo '<tr>
         <th scope="row">'.$id.'</th>
         <td>'.$name.'</td>
         <td>'.$email.'</td> 
         <td>'.$password.'</td>
         <td>
         <button class="btn btn-primary"> <a href="update.php?updateid='.$id.'" class="text-light">Update</a> </button>
         <button class="btn btn-danger"> <a href="delete.php?deleteid='.$id.'" class="text-light">Delete</a> </button>
         </td>
         </tr>';
      }
    }
  }

  public function deleteRecord($id){
    $con = $this->connect();
    $sql = "DELETE FROM ".$this->TABLE_NAME." where id=$id ";
    $result = mysqli_query($con , $sql);
    if($result){
      // echo "Deleted successfully";
      header('Location:index.php');
    }else{
      die(mysqli_error($con));
    }  
  }   


  public function updateRecord($id , $name , $email){
    $con = $this->connect();
    $sql = "UPDATE ".$this->TABLE_NAME." SET id=$id , name='$name', email='$email' where id='$id' ";
    $result = (mysqli_query($con , $sql));
    if($result){
      echo "updated";
    }else{
     die(mysqli_error($con));

    }  
  }  

   

}

?>