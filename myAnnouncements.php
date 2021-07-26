
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    </head>
    <body>

    <?php 
    require 'MyDB.php';
    if(isset($_GET['userid'])){
        $userid = $_GET['userid'];

        $db = new MyDB();
        $rows = $db->getUserByID($userid);
    
        $row = $rows->fetch_assoc();
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

        $jobs = $db->getMyAnnouncements($userid);
        echo "<center>"  ;           
        echo "<table class='table table-striped table-hover' style='width:70%'>";

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
        echo "</center>"  ;           

    }
    else{
        header("location:index.php");
    }

?>
</body>
</html>