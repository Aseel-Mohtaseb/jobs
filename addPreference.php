<?php
    require 'MyDB.php';

    if(isset($_GET['userid'])){
        $userid = $_GET['userid'];
        $db = new MyDB();

        if(isset($_POST['category'])){
            $category = $_POST['category'];

            if($category != 'Select category'){
                $result = $db->addPrefCategory($userid, $category);
                if($result){
                    echo "category successfuly <br>" ;
                }
                else{
                    echo " category Something went wrong! <br>";
                }
        
            }

        }

        if(isset($_POST['city'])){
            $city = $_POST['city'];
            if($city != 'Select city'){
                $result = $db->addPrefCity($userid, $city);
                if($result){
                    echo "city successfuly <br>";
                }
                else{
                    echo " city Something went wrong! <br>";
                }
            }
        }

        if(isset($_POST['type'])){
            $type = $_POST['type'];
            $result = $db->addPrefType($userid, $type);
            if($result){
                echo "type successfuly <br>";
            }
            else{
                echo " type Something went wrong! <br>";
            }
        }

        if(isset($_POST['sponsored'])){
            $sponsored = $_POST['sponsored'];
            $result = $db->addPrefSponsored($userid, $sponsored);
            if($result){
                echo "resp successfuly <br>";
            }
            else{
                echo " resp Something went wrong! <br>";
            }
        }

        
        header("location:profile.php?userid=$userid");

    }
    else 
    {
        echo "errror";
    }
?>