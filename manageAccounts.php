<?php 
    require 'MyDB.php';

    if (isset($_COOKIE['email'])){
        $email = $_COOKIE['email'];
       
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


        $users = $db->getUsers();
            
            
        echo "<table class='table table-hover'";

        echo "<thead> <tr>"; 
        echo "<th scope='col'>User Name</th>";
        echo "<th scope='col'>Email</th>";
        echo "<th scope='col'>Details</th>";
        echo "<th scope='col'>Delete</th>";
        echo "</tr> </thead>";

        foreach($users as $row){
            $id = $row["id"];

            echo "<tr>";
            echo "<td>" . $row["user_name"] . "</td>"; 
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . "<a href='userDetails.php?id=$id'>Details</a>" . "</td>";
            echo "<td>" . "<a href='deleteUser.php?id=$id'>delete</a>" . "</td>";
            echo "</tr>";
        }
        echo "</table>";


    }
    else{
        header("location:login.php");
    }

?>

<html>
<head>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
</head>
</html>