
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    </head>
    <body>

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

            if($user_type == 1){
                echo "<li><a href='jobForm.php?userid=$userid'>Add Job</a></li>";// for business owner
                echo "<li><a href='myAnnouncements.php?userid=$userid'>My Announcements</a></li>";// for business owner
            }
            if($user_type == 0){
                echo "<li><a href='profile.php?userid=$userid'>my Profile</a></li>";// for job seeker
            }
            
            echo "<li><a href='mostViewed.php'>Most viewed Job offer</a></li>";//for both 
            echo "<li><a href='logout.php'>Logout</a><br>";
            echo "</ul>";


        $jobs = $db->getMostViewedJobs();

        $order = 1;

        echo "<table class='table table-striped table-hover'>";

        echo "<tr>"; 
        echo "<th>#</th>";
        echo "<th>Image</th>";
        echo "<th>Job Title</th>";
        echo "<th>Company name</th>";
        echo "<th>Details</th>";
        echo "</tr>";

        foreach($jobs as $row){
            $id = $row["id"];
            echo "<tr>";
            echo "<td>" . $order . "</td>";    $order++;
            $imageURL = $row["img"];
            echo "<td>" . '<img src="' .  $imageURL . '" width = 100px />' . "</td>";
            echo "<td>" . $row["job_title"] . "</td>";
            echo "<td>" . $row["company_name"] . "</td>";
            echo "<td>" . "<a href='jobDetails.php?id=$id'>Details</a>" . "</td>";
            echo "</tr>";
        }
        echo "</table>";



    }
    else{
        header("location:login.php");
    }


?>

</body>
</html>