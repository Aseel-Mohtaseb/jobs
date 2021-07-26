<?php
    require 'MyDB.php';

    if(isset($_GET['userid'])){
        $userid = $_GET['userid'];
        $jobTitle = $_POST['jobTitle'];
        $companyName = $_POST['companyName'];
        $city = $_POST['city'];
        $description = $_POST['description'];
        $salary = $_POST['salary'];
        $teleNo = $_POST['teleNo'];
        $email = $_POST['email'];
        $type = $_POST['type'];
        $category = $_POST['category'];
        

        $upFile = "images/".$_FILES["image"]["name"];
        $img = $upFile;
         
	    if(is_uploaded_file($_FILES["image"]["tmp_name"])) {
		if(!move_uploaded_file($_FILES["image"]["tmp_name"], $upFile)) {  
            exit;
		}
        } else { 
            $img = "http://localhost/jobs/images/img.jpg" ; //defult image
        }



        if(isset($_POST['sponsored'])){
            $sponsored = $_POST['sponsored'];
        }
        else{
            $sponsored = 0;
        }

        $db = new MyDB();
        $result = $db->addJob($jobTitle, $companyName, $city, $description, $salary, $teleNo,
                              $email, $type, $category, $img, $sponsored, $userid);


        if($result){
            header("location:jobForm.php?userid=$userid");
            echo "User added successfuly";
            echo "user: " . $userid;
        }
        else{
            echo "Something went wrong!";
        }
    }
    else 
    {
        echo "error";
    }
?>