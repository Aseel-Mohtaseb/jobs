<?php
require 'MyDB.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $category = $_POST['category'];

    $db = new MyDB();
    $result = $db->getJobById($id);
    $userid = $result['user_id'];
    $result = $db->updateCategory($id, $category);

    if($result){
        header("location:jobDetails.php?id=$id&userid=$userid");
        echo "job category was updated successfully";
    }
    else{
        echo "Something went wrong!";
    }
}
?>