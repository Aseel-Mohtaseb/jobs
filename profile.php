<?php
    require 'myDB.php';

    if(isset($_GET['userid'])){
        $userid = $_GET['userid'];
        $db = new MyDB(); 
        
        $rows = $db->getUserById($userid);
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

?>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
        <h2>preference</h2>
        <div class="row">
            <div class="col-md-6">
        
                <form action="addPreference.php?userid=<?php echo $userid?>" method="post">

                      <div class="form-group">
                        <label>Category</label> 
                        <select  name="category" class="form-control" >

                            <option selected="selected">
                            <?php if ($row['job_category'] != NULL) echo $row['job_category']?>
                            </option>

                            <?php 
                                $categories = $db->getCategoryName();

                                foreach($categories as $row2){
                                    echo "<option>" . $row2["category_name"] . "</option>";
                                }
                            ?>

                        </select>

                      </div>

                      <div class="form-group">
                        <label>City</label>
                        <select  name="city" class="form-control" >

                            <option selected="selected">
                            <?php if ($row['job_city'] != NULL) echo $row['job_city']?>
                            </option>

                            <?php 
                                $city = $db->getCity();

                                foreach($city as $row3){
                                    echo "<option>" . $row3["city"] . "</option>";
                                }
                            ?>

                        </select>
                      </div>

                
                      
                     <label>Type</label>
                     <div class="radio">
                       <label><input type="radio" name="type" value="1" <?php if ($row['job_type'] == '1') echo 'checked="checked"'; ?>> full-time</label>
                     </div>
                     <div class="radio">
                       <label><input type="radio" name="type" value="0" <?php if ($row['job_type'] == '0') echo 'checked="checked"'; ?>> part-time</label>
                     </div>

                     <div class="form-group">
                        <label>Sponsored</label>
                        <input type="checkbox" name="sponsored" value="1" <?php if ($row['job_sponsored'] == '1') echo 'checked="checked"'; ?>>
                      </div>

                      <button type="submit" class="btn btn-primary">Add preference</button>
                </form>

            </div>
            <div class="col-md-6"></div>
        </div>
        </div>

    </body>
</html>


<?php

    $job_category = $row["job_category"];
    $job_city = $row["job_city"];
    $job_type = $row["job_type"];
    $job_sponsored = $row["job_sponsored"];

    $jobs = $db->getJobsByPref($job_category, $job_city, $job_type, $job_sponsored);

    if (mysqli_num_rows($jobs) > 0){

        echo "<table class='table table-hover'>";

        echo "<thead> <tr>"; 
        echo "<th scope='col'>Image</th>";
        echo "<th scope='col'>Job Title</th>";
        echo "<th scope='col'>Company name</th>";
        echo "<th scope='col'>Details</th>";
        echo "</tr> </thead> <tbody>";


        foreach($jobs as $row){
            $id = $row["id"];
            echo "<tr>";
            $imageURL = $row["img"];
            echo "<td>" . '<img src="' .  $imageURL . '" width = 100px />' . "</td>";
            echo "<td>" . $row["job_title"] . "</td>";
            echo "<td>" . $row["company_name"] . "</td>";
            echo "<td>" . "<a href='jobDetails.php?id=$id'>Details</a>" . "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";
    }
    echo '</div>';
    }
    else{
        header("location:index.php");
    }

?>