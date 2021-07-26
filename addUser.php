<?php
    require 'MyDB.php';

    $email = $_POST['email'];
    $password = $_POST['pw'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $teleNo = $_POST['teleNo'];
    $type = $_POST['type'];

    $db = new MyDB();
    $result = $db->addUser($username, $password, $teleNo, $address, $email, $type);

    if($result){
        echo "User added successfuly";
    }
    else{
        echo "Something went wrong!";
    }
?>