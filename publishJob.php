<?php
    require 'MyDB.php';

    if (isset($_GET['id'])){ 
        $id = $_GET['id'];
        $db = new MyDB();
        $result = $db->publishJob($id);
        if($result){
            header("location:admin.php");  
        }
        else{
            echo "Something went wrong!";
        }
        
    }
?>