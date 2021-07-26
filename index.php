
<html>
<head>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    function loadXMLDoc()
    {
    var xmlhttp;
    if (window.XMLHttpRequest)  {   // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else  {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("ajaxtable").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","index.php?ajax=1",true); 
    xmlhttp.send();
    }


    setInterval(() => {
        loadXMLDoc()
    }, 10000);


</script>
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

            //So as not to be replayed
            if(!isset($_GET['ajax'])){
                echo '<div class="container">';
                echo '<div class="header">';
                echo '<img id="headerImg" src="jobsLogo.png">';
                echo '<h1>JOBS</h1>';
                echo "<h4>Welcome " . $row['user_name'] . "</h4><br>";
    
            echo '</div>'; //header end

            echo '<ul class="navBar">';
            echo "<li><a href='index.php'>Home</a></li>";

                // for business owner
                if($user_type == 1){
                    echo "<li><a href='jobForm.php?userid=$userid'>Add Job</a></li>";
                    echo "<li><a href='myAnnouncements.php?userid=$userid'>My Announcements</a></li>";
                    echo "<li><a href='mostViewed.php'>Most viewed Job offer</a></li>";
                }
                // for job seeker
                if($user_type == 0){
                    echo "<li><a href='profile.php?userid=$userid'>my Profile</a></li>";
                    echo "<li><a href='mostViewed.php'>Most viewed Job offer</a></li>";
                }
                // for admin
                if($user_type == 2){
                    echo "<li><a href='manageAccounts.php'>manage users accounts</a></li>";
                    echo "<li><a href='admin.php'>manage jobs offering</a></li>";
                    echo "<li><a href='controlAdvertisements.php'>control advertisements</a></li>";
                }
                //for all users
                echo "<li><a href='logout.php'>Logout</a><br>";
                echo "</ul>";

                require 'searchForm.php';
            }

            $jobs = $db->getJobs();
            $sponsoredJobs = $db->getSponsoredJobs();

            if(!isset($_GET['ajax'])){
                echo "<div id='SponsoredJobs'>";
                echo "<h2 class='tableHeader'> sponsored jobs: </h2>";
                echo "<table class='table caption-top' style='width:100%' >";
                echo "<thead> <tr>"; 
                echo "<th scope='col'>Image</th>";
                echo "<th scope='col'>Job Title</th>";
                echo "<th scope='col'>Company name</th>";
                echo "<th scope='col'>Details</th>";
                echo "</tr> </thead>";

                foreach($sponsoredJobs as $srow){
                    $sid = $srow["id"];
                    echo "<tbody> <tr>";
                    $imageURL = $srow["img"];
                    echo "<td>" . '<img src="' .  $imageURL . '" width = 100px />' . "</td>";
                    echo "<td>" . $srow["job_title"] . "</td>";
                    echo "<td>" . $srow["company_name"] . "</td>";
                    echo "<td>" . "<a href='jobDetails.php?id=$sid'>Details</a>" . "</td>";
                    echo "</tr> </tbody>";
                }
                echo "</table>";
                echo "</div>"; //id='SponsoredJobs'
                echo "<h2 class='tableHeader'> Jobs offering: </h2>";


            }

            if (isset($_POST['criteria']) && isset($_POST['criteriValue'])){
                $db2 = new MyDB();
                $criteria = $_POST['criteria'];
                $criteriValue = $_POST['criteriValue'];

                if($criteria == 'title'){
                    $jobs = $db2->searchTitle($criteriValue);
                }
                else if($criteria == 'category'){
                    $jobs = $db2->searchCategory($criteriValue);
                }
                else if($criteria == 'city'){
                    $jobs = $db2->searchCity($criteriValue);
                }


                if (mysqli_num_rows($jobs) <= 0){
                    echo "no results <br>"; 
                }
                
            }

                echo "<table id='ajaxtable' class='table caption-top' style='width:50%' >";

                echo "<thead> <tr>"; 
                echo "<th scope='col'>Image</th>";
                echo "<th scope='col'>Job Title</th>";
                echo "<th scope='col'>Company name</th>";
                echo "<th scope='col'>Details</th>";
                echo "</tr> </thead>";


                foreach($jobs as $row){
                    $id = $row["id"];
                    echo "<tbody> <tr>";
                    $imageURL = $row["img"];
                    echo "<td>" . '<img src="' .  $imageURL . '"width = 100px />' . "</td>";
                    echo "<td>" . $row["job_title"] . "</td>";
                    echo "<td>" . $row["company_name"] . "</td>";
                    echo "<td>" . "<a href='jobDetails.php?id=$id'>Details</a>" . "</td>";
                    echo "</tr> </tbody>";
                }
                echo "</table>";

               


        }
        else{
            header("location:login.php");
        }

        if(!isset($_GET['ajax'])){
    ?>
    <div class = "footer">
        <br><br><hr> 
        <h5>We hope you will benefit</h5>
    </div>
            <?php }?>
</div>

</body>
</html>


