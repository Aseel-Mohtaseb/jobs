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
?>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">

    </head>
    <body>
        <div class="container">
        <h2>Job Offer Form</h2>
        <div class="row">
            <div class="col-md-6">
        
                <form action="addJob.php?userid=<?php echo $userid?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Job Title</label>
                        <input required type="text" name="jobTitle" class="form-control"  placeholder="Enter job title">
                    </div>
                    
                    <div class="form-group">
                        <label>Company Name</label>
                        <input required type="text" name="companyName" class="form-control"  placeholder="Enter Company name">
                      </div>

                      <div class="form-group">
                        <label>Category</label> 
                        <select  name="category" class="form-control" required>
                            <option>Select type</option>
                            <?php 
                                $db = new MyDB();
                                $categories = $db->getCategoryName();

                                foreach($categories as $row){
                                    echo "<option>" . $row["category_name"] . "</option>";
                                }
                            ?>

                        </select>
                      </div>
                      <div class="form-group">
                        <label>City</label>
                        <input required type="text" name="city" class="form-control"  placeholder="Enter city">
                      </div>

                      <div class="form-group">
                        <label>Job Description</label>
                        <input required type="text" name="description" class="form-control"  placeholder="Enter job description">
                      </div>

                      <div class="form-group">
                        <label>Salary</label>
                        <input required type="number" name="salary" class="form-control"  placeholder="Enter salary">
                      </div>

                      <div class="form-group">
                        <label>Telephone Number</label>
                        <input required type="number" name="teleNo" class="form-control"  placeholder="Enter your telephone number">
                      </div>

                      <div class="form-group">
                        <label>Email</label> 
                        <input required type="email" name="email" class="form-control"  placeholder="Enter your email">
                      </div>
                      
                      <div class="form-group">
                        <label>Upload Your Image
                        <input type="file" name="image" />
                      </label>

                      </div>
                      
                     <label>Type</label>
                     <div class="radio">
                       <label><input type="radio" name="type" value="1" checked > full-time</label>
                     </div>
                     <div class="radio">
                       <label><input type="radio" name="type" value="0"> part-time</label>
                     </div>

                     <div class="form-group">
                        <label>Sponsored</label>
                        <input type="checkbox" name="sponsored" value="1">
                      </div>

                      <button type="submit" class="btn btn-primary">Add job</button>
                </form>

            </div>
            <div class="col-md-6"></div>
        </div>
        

        </div>
    </body>
</html>


<?php

}
else{
    header("location:index.php");
}

?>