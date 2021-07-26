<?php

if(isset($_COOKIE['email'])){
    setcookie("email", "", time() - 3600);
}
header("location:login.php");

?>