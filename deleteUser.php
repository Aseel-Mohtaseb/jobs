<?php
require 'MyDB.php';

if (isset($_GET['id'])){
    $id = $_GET['id'];

    $db = new MyDB();
    $result = $db->getJobById($id);
    $userid = $result['user_id'];

    $result = $db->deleteUser($id);


    if($result){
        header("location:manageAccounts.php"); 
    }
    else{
        echo "Something went wrong!";
    }
}
else{
    header("location:index.php");
}
