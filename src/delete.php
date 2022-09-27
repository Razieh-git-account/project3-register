<?php
include_once('Database.php');
if(isset($_GET['deleteid'])){
    $id= $_GET['deleteid'];
    $object = new Database();
    $object->deleteRecord($id);
}

?>