<?php 
require 'MyDB.php';
if (isset($_COOKIE['email'])){
        $email = $_COOKIE['email'];

        $db = new MyDB();
        $rows = $db->getUserByEmail($email);
        $rowu = $rows->fetch_assoc();
        $user_type = $rowu['type'];
        $userid = $rowu['id'];

        echo '<div class="container">';
                echo '<div class="header">';
                echo '<img id="headerImg" src="jobsLogo.png">';
                echo '<h1>JOBS</h1>';
                echo "<h4>Welcome " . $rowu['user_name'] . "</h4><br>";
    
            echo '</div>'; //header end

            echo '<ul class="navBar">';

            echo "<li><a href='index.php'>Home</a></li>";

                // for admin
                if($user_type == 2){
                    echo "<li><a href='manageAccounts.php'>manage users accounts</a></li>";
                    echo "<li><a href='admin.php'>manage jobs offering</a></li>";
                    echo "<li><a href='controlAdvertisements.php'>control advertisements</a></li>";
                }
                
                echo "<li><a href='logout.php'>Logout</a><br>";
                echo "</ul>";
        $jobs = $db->getJobs();

        echo "<table class='table table-striped'>";

        echo "<tr>";
        echo "<th>Job Title</th>";
        echo "<th>to update</th>";
        echo "<th>to delete</th>";
        echo "</tr>";

        foreach($jobs as $row){
            $id = $row["id"]; 
            echo "<tr>";
            echo "<td>" . $row["job_title"] . "</td>";
            echo "<td>" . "<a href='updateJobForm.php?id=$id'>update</a>" . "</td>";
            echo "<td>" . "<a href='deleteJob.php?id=$id'>delete</a>" . "</td>";
            echo "</tr>";
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