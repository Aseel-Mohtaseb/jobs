<?php
require 'MyDB.php';
if (isset($_COOKIE['email'])){
    $email = $_COOKIE['email'];

    if (isset($_GET['id'])){

        $id = $_GET['id'];
        $db = new MyDB();
        $row = $db->getJobDetails($id);

        $userid = $row['user_id'];
        $rows = $db->getUserByEmail($email);

        $rowu = $rows->fetch_assoc();
        $user_type = $rowu['type'];

        echo '<div class="container">';
                echo '<div class="header">';
                echo '<img id="headerImg" src="jobsLogo.png">';
                echo '<h1>JOBS</h1>';
                echo "<h4>Welcome " . $rowu['user_name'] . "</h4><br>";
    
            echo '</div>'; //header end

            echo '<ul class="navBar">';

            echo "<li><a href='index.php'>Home</a></li>";

                if($user_type == 1){
                    echo "<li><a href='jobForm.php?userid=$userid'>Add Job</a></li>";// for business owner
                    echo "<li><a href='myAnnouncements.php?userid=$userid'>My Announcements</a></li>";// for business owner
                    echo "<li><a href='mostViewed.php'>Most viewed Job offer</a></li>";
                }
                if($user_type == 0){
                    echo "<li><a href='profile.php?userid=$userid'>my Profile</a></li>";// for job seeker
                    echo "<li><a href='mostViewed.php'>Most viewed Job offer</a></li>";
                }
                // for admin
                if($user_type == 2){
                    echo "<li><a href='manageAccounts.php'>manage users accounts</a></li>";
                    echo "<li><a href='admin.php'>manage jobs offering</a></li>";
                    echo "<li><a href='controlAdvertisements.php'>control advertisements</a></li>";
                }
                
                echo "<li><a href='logout.php'>Logout</a><br>";
                echo "</ul>";


        echo "<div id='jobDetails'>";       
        echo "Job title: " . $row['job_title'];
        echo "<br> <hr>";
        echo "Category: " . $row['category_name'];
        echo "<br> <hr>";
        echo "Company name: " . $row['company_name'];
        echo "<br> <hr>";
        echo "Type: ";

        if($row['type'] == 1)
            echo "full time";
        else
            echo "part time";

        echo "<br> <hr>";
        echo "City: " . $row['city'];
        echo "<br> <hr>";
        echo "Job description: " . $row['job_description'];
        echo "<br> <hr>";
        echo "Salary: " . $row['salary'];
        echo "<br> <hr>";
        echo "Date of publication: " . $row['date'];
        echo "<br> <hr>";
        echo "Telephone number: " . $row['teleNo'];
        echo "<br> <hr>";
        echo "Email: " . $row['email'];
        echo "<br> <hr>";
        $imageURL = $row["img"];
        echo "Image: " . '<img src="' .  $imageURL . '" width = 100px />';
        echo "<br> <hr>";
        echo "featured Job? ";
        if($row['sponsored'] == 1)
            echo "Yes, featured Job";
        else 
            echo "No,not featured Job";
        echo "<br> <hr>";


        //to increase counter for this job
        
        $db2 = new MyDB();
        $row2 = $db2->increaseCounter($id);
    

        //admin
        if(isset($_GET['userid'])){
        echo "Change category name: <br><br>";
        echo "<form action='updateCategory.php?id=$id' method='POST'>" .
        '<select  name="category" class="form-control" required>' . 

        '<option selected="selected">';
            echo $row['category_name'];
            echo '</option>' . 

            '<option>Or select another type</option>' ;

                $db2 = new MyDB();
                $categories = $db2->getCategoryName(); 

                foreach($categories as $row2){
                  if($row2["category_name"] != $row['category_name']){
                    echo "<option>" . $row2["category_name"] . "</option>";
                  }
                }
            

        echo '</select>';
        echo '<br><button type="submit" class="btn btn-primary">Change</button> <br>';
        echo "</form>";
            }

        }
    
}
else{
    header("location:index.php");
}

?>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" 
src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0" nonce="7ZHmqb6g"></script>

<div class="fb-like" data-href="http://localhost/jobs/jobDetails.php?id=$id" data-width="" data-layout="standard" 
data-action="like" data-size="small" data-share="true"></div>
</div> 
</div>       
<br><br>
</body>
</html>