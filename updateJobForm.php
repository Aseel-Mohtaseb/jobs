<?php
require 'MyDB.php';
if (isset($_COOKIE['email'])){
    $email = $_COOKIE['email'];

    if(isset($_GET['id'])){

    $id = $_GET['id'];
    $db1 = new MyDB();
    $row = $db1->getJobById($id);

    $userid = $row['user_id'];
    $rows = $db1->getUserByEmail($email);

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

?>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h2>Update Job Form</h2>
        <div class="row">
            <div class="col-md-6">
        
                <form action="updateJob.php?id=<?php echo $row['id']?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Job Title</label>
                        <input required type="text" name="jobTitle" value="<?php echo $row['job_title']?>" class="form-control"  placeholder="Enter job title">
                    </div>
                    
                    <div class="form-group">
                        <label>Company Name</label>
                        <input required type="text" name="companyName" value="<?php echo $row['company_name']?>" class="form-control"  placeholder="Enter Company name">
                      </div>
                      
                      <div class="form-group">
                        <label>City</label>
                        <input required type="text" name="city" value="<?php echo $row['city']?>" class="form-control"  placeholder="Enter city">
                      </div>

                      <div class="form-group">
                        <label>Job Description</label>
                        <input required type="text" name="description" value="<?php echo $row['job_description']?>" class="form-control"  placeholder="Enter job description">
                      </div>

                      <div class="form-group">
                        <label>Salary</label>
                        <input required type="number" name="salary" value="<?php echo $row['salary']?>" class="form-control"  placeholder="Enter salary">
                      </div>

                      <div class="form-group">
                        <label>Telephone Number</label>
                        <input required type="number" name="teleNo" value="<?php echo $row['teleNo']?>" class="form-control"  placeholder="Enter your telephone number">
                      </div>

                      <div class="form-group">
                        <label>Email</label> 
                        <input required type="email" name="email" value="<?php echo $row['email']?>" class="form-control"  placeholder="Enter your email">
                      </div>
                      
                     <label>Type</label>
                     <div class="radio">
                       <label><input type="radio" name="type" value="1" <?php if ($row['type'] == '1') echo 'checked="checked"'; ?>> full-time</label>
                     </div>
                     <div class="radio">
                       <label><input type="radio" name="type" value="0" <?php if ($row['type'] == '0') echo 'checked="checked"'; ?>> part-time</label>
                     </div>

                     <div class="form-group">
                        <label>Category</label>
                        <select  name="category" class="form-control" required>

                        <option selected="selected">
                            <?php echo $row['category_name']?>
                            </option>

                            <option>Or select another type</option>

                            <?php 
                                $db2 = new MyDB();
                                $categories = $db2->getCategoryName(); 

                                foreach($categories as $row2){
                                  if($row2["category_name"] != $row['category_name']){
                                    echo "<option>" . $row2["category_name"] . "</option>";
                                  }
                                }
                            ?>

                        </select>
                      </div>
                      <div class="form-group">
                        <label>Sponsored</label>
                        <input type="checkbox" name="sponsored" value="1" <?php if ($row['sponsored'] == '1') echo 'checked="checked"'; ?>>
                      </div>
                      <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
            <div class="col-md-6"></div>
        </div>
        </div>
    </body>
</html>

<?php
}
}
else{
    header("location:index.php");
}

?>