<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">

</head>
<body style="background-image: url('background.jpg');">
<div class="container" style="   background-color: rgba(190, 203, 223, 0.5); ">
    <div class="header">
        <img id="headerImg" src="jobsLogo.png">
        <h1>JOBS</h1>
        <h4>Welcome </h4><br>
        <hr>
    </div>

        <div style='float: right; background-color:rgb(42, 42, 128);color:cornsilk;padding: 20px;border: darkgray 4px solid;'>
            <h2>Are you looking for a job?</h2>
            <h2>Do you need employees?</h2>
            <h2>Our website will help you</h2>
        </div>
        <h2 style='margin-left:20px'>Login Form</h2><br>
        <div class="row" >
            <div class="col-md-10">
                
                <form action="check.php" method="post">
                    
                    <div class="form-group">
                        <label >Email</label>
                        <input required type="email" name="email" class="form-control" placeholder="Enter your email">
                    </div>
                      
                    <div class="form-group">
                        <label>Password</label>
                        <input required type="password" name="pw" class="form-control" placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    
                </form>
                <h6>if you dont have account <a href='registrationForm.php'>Sign up</a></h6>

            </div>
 
        </div>


        <div class="row">
                <div class="col-md-10">
                    <?php
                        if (isset($_GET['error'])){
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Invalid email or Password!
                            </div>
                          <?php
                        }
                    ?>
                </div>
        </div>
        
</div>
    
</body>
</html>