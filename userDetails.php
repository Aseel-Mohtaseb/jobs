<?php
require 'MyDB.php';
if (isset($_COOKIE['email'])){
    $email = $_COOKIE['email'];
    if (isset($_GET['id'])){
        
        $id = $_GET['id'];

        $db = new MyDB();
        $rows = $db->getUserByEmail($email);

            $row = $rows->fetch_assoc();
            $userid = $row['id'];
            $user_type = $row['type'];

                echo '<div class="container">';
                echo '<div class="header">';
                echo '<img id="headerImg" src="jobsLogo.png">';
                echo '<h1>JOBS</h1>';
                echo "<h4>Welcome " . $row['user_name'] . "</h4><br>";
    
            echo '</div>'; //header end

            echo '<ul class="navBar">';
            echo "<li><a href='index.php'>Home</a></li>";

                // for admin
                if($user_type == 2){
                    echo "<li><a href='manageAccounts.php'>manage users accounts</a></li>";
                    echo "<li><a href='admin.php'>manage jobs offering</a></li>";
                    echo "<li><a href='controlAdvertisements.php'>control advertisements</a></li>";
                }
                //for all users
                echo "<li><a href='logout.php'>Logout</a><br>";
                echo "</ul>";

        $row = $db->getUserDetails($id);
        echo "<div id='userDetails' >";
        echo "User id: " . $row['id'];
        echo "<br><hr>";
        echo "User name: " . $row['user_name'];
        echo "<br><hr>";
        echo "Email: " . $row['email'];
        echo "<br><hr>";
        echo "Telephone number: " . $row['teleNo'];
        echo "<br><hr>";
        echo "Address: " . $row['address'];
        echo "<br><hr>";
        echo "Type: ";

        if($row['type'] == 1)
            echo "business owner";
        else
            echo "job seeker";

        echo "<br> </div>";
   
}
}
else{
    header("location:index.php");
}

?>

<html>
<head>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
</head>
</html>

