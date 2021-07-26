<?php
require 'MyDB.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $jobTitle = $_POST['jobTitle'];
    $companyName = $_POST['companyName'];
    $city = $_POST['city'];
    $description = $_POST['description'];
    $salary = $_POST['salary'];
    $teleNo = $_POST['teleNo'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $category = $_POST['category'];

    if(isset($_POST['sponsored'])){
        $sponsored = $_POST['sponsored'];
    }
    else{
        $sponsored = 0;
    }

    $db = new MyDB();
    $result = $db->updateJob($id, $jobTitle, $companyName, $city, $description, $salary, $teleNo, $email, $type, $category, $sponsored);

    if($result){

        header("location:updateJobForm.php?id=$id");
        echo "job record was updated successfully";
    }
    else{
        echo "Something went wrong!";
    }
}
else{
    header("location:index.php");
}


?>