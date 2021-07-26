<?php
    class MyDB{

        private static $connection;

        public function connect(){
            if(!isset(self::$connection)){
                self::$connection = new mysqli("localhost", "user_jobs", "userjobspw", "jobs");
            }

            if(self::$connection == false){
                echo "No connection" . self::$connection->connect_error;
            }
            return self::$connection;
        }

        public function getJobs(){
            $query = "SELECT * FROM jobs where publish=1 ORDER BY date DESC";
            $conn = $this->connect();
            $result = $conn->query($query);

            $rows = array(); 

            while($row = $result-> fetch_assoc()){
                $rows[] = $row;
   
            }
            return $rows;
        }

        public function getUnPublishedJobs(){
            $query = "SELECT * FROM jobs where publish=0";
            $conn = $this->connect();
            $result = $conn->query($query);

            $rows = array(); 

            while($row = $result-> fetch_assoc()){
                $rows[] = $row;
   
            }
            return $rows;
        }

        public function getSponsoredJobs(){
            $query = "SELECT * FROM jobs where publish=1 AND sponsored=1 limit 6";
            $conn = $this->connect();
            $result = $conn->query($query);

            $rows = array(); 

            while($row = $result-> fetch_assoc()){
                $rows[] = $row;
   
            }
            return $rows;
        }

        public function publishJob($id){
            $query = "UPDATE jobs SET publish=1 where id=$id";
            $conn = $this->connect();
            $result = $conn->query($query);
            return $result;
        }

        public function getJobById($id){
            $query = "SELECT * FROM jobs WHERE id=$id";

            $conn = $this->connect();
            $result = $conn->query($query);

            $row = $result->fetch_assoc();

            return $row; 
        }

        public function addUser($username, $password, $teleNo, $address, $email, $type){
            $query = "INSERT INTO users (user_name, password, teleNo, address, email, type) 
                      VALUES ('$username', '$password', $teleNo, '$address', '$email', '$type')";

            $conn = $this->connect();
            $result = $conn->query($query);

            return $result;
        }


        public function getUserById($id){
            $query = "SELECT * FROM users WHERE id=$id";
            $conn = $this->connect();
            $result = $conn->query($query);
            return $result;       
        }

        public function getUserByEmail($email){
            $query = "SELECT * FROM users WHERE email='$email'";
            $conn = $this->connect();
            $result = $conn->query($query);
            return $result;       
        }

        public function getUserByEmailAndPW($email ,$password){
            $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $conn = $this->connect();
            $result = $conn->query($query);
            return $result;

        }


        public function addJob($jobTitle, $companyName, $city, $description, $salary, $teleNo, $email, $type, $category, $img, $sponsored, $userid){
            $query = "INSERT INTO jobs (job_title, company_name, city, job_description, salary, teleNo, email, type, category_name, img, sponsored, user_id) 
                      VALUES ('$jobTitle', '$companyName', '$city', '$description', $salary, $teleNo, '$email', $type, '$category','$img', '$sponsored', $userid)";

            $conn = $this->connect();
            $result = $conn->query($query);

            return $result;
        }

        public function deleteJob($id){
            $query = "DELETE FROM jobs WHERE id=$id";
            $conn = $this->connect();
            $result = $conn->query($query);

            return $result;
        }
        
        public function updateJob($id, $jobTitle, $companyName, $city, $description, $salary, $teleNo, $email, $type, $category, $sponsored){
            $query = "UPDATE jobs SET job_title='$jobTitle', company_name='$companyName', city='$city', job_description='$description',
                 salary=$salary, teleNo=$teleNo, email='$email', type='$type', category_name='$category',
                 sponsored='$sponsored' WHERE id=$id";

            $conn = $this->connect();
            $result = $conn->query($query);

            return $result;
        }

        public function getMyAnnouncements($userid){
            $query = "SELECT * FROM jobs WHERE user_id=$userid";

            $conn = $this->connect();
            $result = $conn->query($query);

            $rows = array();

            while($row = $result-> fetch_assoc()){
                $rows[] = $row;
   
            }
            return $rows;
        }

        public function getJobDetails($id){
            $query = "SELECT * FROM jobs WHERE id=$id";

            $conn = $this->connect();
            $result = $conn->query($query);

            $row = $result->fetch_assoc();

            return $row;
        }


        public function getCategoryName(){
            $query = "SELECT category_name FROM category";
            $conn = $this->connect();
            $result = $conn->query($query);

            $rows = array();

            while($row = $result-> fetch_assoc()){
                $rows[] = $row;
   
            }
            return $rows;
        }

        public function updateCategory($id, $category){
            $query = "UPDATE jobs SET category_name='$category' WHERE id=$id";
            $conn = $this->connect();
            $result = $conn->query($query);
            return $result;
        }

        public function increaseCounter($id){
            $query = "UPDATE jobs SET counter=counter+1 WHERE id=$id";
            $conn = $this->connect();
            $result = $conn->query($query);
            return $result;
        }

        public function getMostViewedJobs(){
            $query = "SELECT * FROM jobs where publish=1 ORDER BY counter desc";
            $conn = $this->connect();
            $result = $conn->query($query);

            $rows = array(); 

            while($row = $result-> fetch_assoc()){
                $rows[] = $row;
   
            }
            return $rows;
        }

        public function searchTitle($title){
            $query = "SELECT * FROM jobs WHERE job_title='$title'";
            $conn = $this->connect();
            $result = $conn->query($query);
            return $result;
        }

        public function searchCategory($category){
            $query = "SELECT * FROM jobs WHERE category_name='$category'";
            $conn = $this->connect();
            $result = $conn->query($query);
            return $result;
        }

        public function searchCity($city){
            $query = "SELECT * FROM jobs WHERE city='$city'";
            $conn = $this->connect();
            $result = $conn->query($query);
            return $result;
        }

        public function getCity(){
            $query = "SELECT DISTINCT city FROM jobs";
            $conn = $this->connect();
            $result = $conn->query($query);

            $rows = array(); 

            while($row = $result-> fetch_assoc()){
                $rows[] = $row;
   
            }
            return $rows;
        }

        //pref = preference
        public function addPrefCategory($id, $category){
            $query = "UPDATE users SET job_category='$category' WHERE id=$id";
            $conn = $this->connect();
            $result = $conn->query($query);
            return $result;
        }

        public function addPrefCity($id, $city){
            $query = "UPDATE users SET job_city='$city' WHERE id=$id";
            $conn = $this->connect();
            $result = $conn->query($query);
            return $result;
        }

        public function addPrefType($id, $type){
            $query = "UPDATE users SET job_type='$type' WHERE id=$id";
            $conn = $this->connect();
            $result = $conn->query($query);
            return $result;
        }

        public function addPrefSponsored($id, $sponsored){
            $query = "UPDATE users SET job_sponsored='$sponsored' WHERE id=$id";
            $conn = $this->connect();
            $result = $conn->query($query);
            return $result;
        }

        public function getJobsByPref($category, $city, $type, $sponsored){
            $query = "SELECT * FROM jobs where category_name='$category' OR city='$city'";
            $conn = $this->connect();
            $result = $conn->query($query);
            return $result;
        }

        public function getUsers(){
            $query = "SELECT * FROM users";
            $conn = $this->connect();
            $result = $conn->query($query);

            $rows = array(); 

            while($row = $result-> fetch_assoc()){
                $rows[] = $row;
   
            }
            return $rows;
        }
    
        public function deleteUser($id){
            $query = "DELETE FROM users WHERE id=$id";
            $conn = $this->connect();
            $result = $conn->query($query);

            return $result;
        }

        public function getUserDetails($id){
            $query = "SELECT * FROM users WHERE id=$id";

            $conn = $this->connect();
            $result = $conn->query($query);

            $row = $result->fetch_assoc();

            return $row;
        }
    }

?>