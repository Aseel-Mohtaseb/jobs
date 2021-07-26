<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
      </head>
    <body>
      <div class="container">
        <div class="header">
        <img id="headerImg" src="jobsLogo.png">
        <h1>JOBS</h1>
        <h4>Welcome </h4><br>
        <hr>
        </div>
        <h2>Registration Form</h2>
  
                <form class="row g-3" action="addUser.php" method="POST">

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input required type="email" name="email" class="form-control"  placeholder="Enter your email">
                      </div>

                      <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input required type="password" name="pw" class="form-control"  placeholder="Enter your password">
                      </div>

                      <div class="col-md-12">
                        <label class="form-label">Address</label>
                        <input required type="text" name="address" class="form-control"  placeholder="Enter your address">
                      </div>


                    <div class="col-md-4">
                        <label class="form-label">Username</label>
                        <input required type="text" name="username" class="form-control"  placeholder="Enter username">
                    </div>
                    

                      <div class="col-md-4">
                        <label class="form-label">Telephone number</label>
                        <input required type="number" name="teleNo" class="form-control"  placeholder="Enter your telephone number">
                      </div>

                      

                      <div class="col-md-4">
                        <label class="form-label">Type</label>
                        <select  name="type" class="form-select" required>
                            <option value="">Select type</option>
                            <option value="0">Job Seeker</option>
                            <option value="1">business owner</option>
                        </select>
                      </div>
                          
                      <div>
                      <label>You can upload your CV (if you are job seeker)
                        <input type="file" name="cv" />
                      </label>
                      </div>
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary">Register</button>
                      </div>
                </form>

        <div class="row">
                <div class="col-md-6">
                    <?php
                        if (isset($_GET['error'])){
                            ?>
                            <div class="alert alert-danger" role="alert">
                              This email has already been used! 
                            </div>
                          <?php
                        }
                    ?>
                </div>
        </div>

      </div>
    </body>
</html>