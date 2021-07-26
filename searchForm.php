<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
            <div class="container" >
                <form action="index.php" method="post" class="row g-3" id="searchForm">

                      <div class="col-auto">
                        <label class="form-control-plaintext" >search by </label> 
                        </div>

                        <div class="col-auto">
                        <select  name="criteria"  class="form-control" required>
                            <option value="title">Job title</option>
                            <option value="category">Category</option>
                            <option value="city">City</option>
                        </select>
                      </div>

                      <div class="col-auto">
                        <input type="text" name="criteriValue" class="form-control"  placeholder="Enter">
                      </div>

                      <div class="col-auto">
                      <button type="submit" class="btn btn-primary mb-3">Search</button>
                      </div>

                </form>

            </div>

    </body>
</html>
