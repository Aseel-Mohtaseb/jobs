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


        $UnPublishedJobs = $db->getUnPublishedJobs();

        echo "<table class='table'>";

        echo " <thead class='thead-dark'><tr>"; 
        echo "<th scope='col'>Job Title</th>";
        echo "<th scope='col'>Details</th>";
        echo "<th scope='col'>Click to post the job</th>";
        echo "</tr></thead>";

        foreach($UnPublishedJobs as $row){
            $id = $row["id"];

            echo "<tr>";
            echo "<td>" . $row["job_title"] . "</td>";
            echo "<td>" . "<a href='jobDetails.php?id=$id&userid=$userid'>Details</a>" . "</td>";
            echo "<td>" . "<a href='publishJob.php?id=$id'>Post the Job</a>" . "</td>";
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
</head>
</html>