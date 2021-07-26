<?php
require 'MyDB.php';
if (isset($_COOKIE['email'])){
    $email = $_COOKIE['email'];

    if (isset($_GET['id'])){
    $id = $_GET['id'];

    $db = new MyDB();
    $rows = $db->getUserByEmail($email);
    $row = $rows->fetch_assoc();
    $usertype = $row['type'];
    $userid = $row['id'];

    $result = $db->deleteJob($id);


    if($result){
        if($usertype == 2){ //for admin
            header("location:controlAdvertisements.php"); //to stay in the same page after delete 
        }
        else 
        header("location:myAnnouncements.php?userid=$userid"); //to stay in the same page after delete  
        
    }
    else{
        echo "Something went wrong!";
    }
}
}
else{
    header("location:index.php");
}
