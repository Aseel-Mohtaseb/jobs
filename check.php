<?php
    require 'MyDB.php';

    if (isset($_POST['email']) && isset($_POST['pw'])){
        $email = $_POST['email'];
        $password = $_POST['pw'];
        $db = new MyDB();
        $result = $db->getUserByEmailAndPW($email ,$password);
        
        if (mysqli_num_rows($result) > 0){
            echo "Welcome " . $email;
            setcookie("email", $email, time() + 2400);
            if($email == 'admin@jobs.com'){
                header("location:admin.php");
            }
            else 
                header("location:index.php");
        }
        else{
            echo "Invalid email or password!!";
            header("location:login.php?error=1");
        }
    }

?>