<?php
  session_start();

  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  require_once "config.php";

  if(isset($_POST["newUserForm"])){
    // create new user
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $homePhone = $_POST["homePhone"];
    $cellPhone = $_POST["cellPhone"];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $sql = "INSERT INTO customers (firstName, lastName, email, address, homePhone, cellPhone) VALUES (?, ?, ?, ?, ?, ?)";
      if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "ssssss", $firstName, $lastName, $email, $address, $homePhone, $cellPhone);
        if(mysqli_stmt_execute($stmt)){
          header("location: users.php");
        }
        else{
          echo "Something went wrong. Please try again.";
        }
        mysqli_stmt_close($stmt);
      }
    }

    mysqli_close($link);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="main.css">

      <title>Users</title>
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
        <h1>The Phone Company</h1>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="products.php">Products</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="news.php">News</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="users.php">Users</a>
              </li>
            </ul>
          </div>

          <?php
            session_start();

            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
              echo('
                <form method="post"> 
                  <input type="submit" name="logout-button"
                          class="btn btn-dark" value="Logout" /> 
                </form> 
                    
              ');
            }

            function logout(){
              // Initialize the session
              session_start();
              
              // Unset all of the session variables
              $_SESSION = array();
              
              // Destroy the session.
              session_destroy();
              
              // Redirect to homepage
              header("location: index.php");
              exit;
            }

            if(array_key_exists('logout-button', $_POST)) { 
              logout(); 
            } 

          ?>
      </nav>

      <div style="margin: 10px 10px 0 10px">
        <h2 style="float: left; margin: 0; padding: 0 0 0 6px">Users (of The Phone Company)</h2>
        &nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="allUsers.php" style="font-size: 15px">All users</a>
        <div style="float: right">
          <span>
            <div style="width:425px">

              <!-- Search button -->
              <div style="width: 280px; float: left">
                <form class="form-inline my-2 my-lg-0" method="post">
                  <input class="form-control mr-sm-2" name="searchField" type="search" placeholder="Names, emails, or phones." aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" name="searchForm" type="submit">Search</button>
                </form>
                <?php

                ?>
              </div>

              <!-- Add user button -->
              <button style="float: right" class="btn btn-outline-primary" data-toggle="modal" data-target="#addUserModal">+ Add User</button>
              
              <!-- Add user modal -->
              <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="margin: 20px auto" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add a new user</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!-- Form -->
                      <form class='needs-validation' novalidate action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="validationFirstName">First Name</label>
                            <input name="firstName" type="text" class="form-control" id="validationFirstName" placeholder="John" value="<?php echo $username; ?>" required>
                            <div class='invalid-feedback'>
                              Please enter a first name.
                            </div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="validationLastName">Last Name</label>
                            <input name="lastName" type="text" class="form-control" id="validationLastName" placeholder="Doe" required>
                            <div class='invalid-feedback'>
                              Please enter a last name.
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="validationAddress">Address</label>
                          <input name="address" type="text" class="form-control" id="validationAddress" placeholder="1234 Main St" required>
                          <div class='invalid-feedback'>
                            Please enter a valid address.
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="validatioinEmail">Email</label>
                          <input name="email" type="email" class="form-control" id="validationAddress" placeholder="john@gmail.com" required>
                          <div class='invalid-feedback'>
                            Please enter a valid email.
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="validationHomePhone">Home Phone</label>
                            <input name="homePhone" type="text" class="form-control" id="validationAddress" placeholder="3342773834" required>
                            <div class='invalid-feedback'>
                              Please enter a valid phone number.
                            </div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="validationCellPhone">Cell Phone</label>
                            <input name="cellPhone" type="text" class="form-control" id="validationCellPhone" placeholder="4489383394" required>
                            <div class='invalid-feedback'>
                              Please enter a valid phone number.
                            </div>
                          </div>
                        </div>
                        <button type="submit" name="newUserForm" class="btn btn-primary" style="float: right; margin: 20px 0 20px 0">Add User</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </span>
        </div>
      </div>
      <br>
      <br>

      <div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">First</th>
              <th scope="col">Last</th>
              <th scope="col">Address</th>
              <th scope="col">Email</th>
              <th scope="col">Home Phone</th>
              <th scope="col">Cell Phone</th>
            </tr>
          </thead>
          <tbody>
            <?php
              require_once "config.php";
              // if user searched for something
              if(isset($_POST["searchForm"])){
                $searchInput = $_POST["searchField"];
                // $searchInput = preg_replace("#[^0-9a-z]#i", "", $searchInput);

                if($_SERVER["REQUEST_METHOD"] == "POST"){
                  $sql = "SELECT * FROM customers WHERE firstName LIKE '%$searchInput%' OR lastName LIKE '%$searchInput%' OR email LIKE '%$searchInput%' OR homePhone LIKE '%$searchInput%' OR cellPhone LIKE '%$searchInput%'";
                  if($searchInput != ''){
                    echo("<h2>Showing results for: ".$searchInput."</h2>");
                  }

                  if($result = mysqli_query($link, $sql)){
                    $rowCount = mysqli_num_rows($result);
                    if($rowCount == 0){
                      echo("<tr>");
                      echo("<td scope='row'>No result.</td>");
                      echo("</tr>");
                    }
                    else{
                      while($row = mysqli_fetch_assoc($result)){
                        echo("<tr>");
                        echo("<th scope='row'>".$row["customerID"]."</th>");
                        echo("<td>".$row["firstName"]."</td>");
                        echo("<td>".$row["lastName"]."</td>");
                        echo("<td>".$row["address"]."</td>");
                        echo("<td>".$row["email"]."</td>");
                        echo("<td>".$row["homePhone"]."</td>");
                        echo("<td>".$row["cellPhone"]."</td>");
                        echo("</tr>");
                      }
                    }
                    mysqli_free_result($result);
                  }

                }
              }
              else{
                $sql = "SELECT * FROM customers";

                if($result = mysqli_query($link, $sql)){
                  while($row = mysqli_fetch_assoc($result)){
                    echo("<tr>");
                    echo("<th scope='row'>".$row["customerID"]."</th>");
                    echo("<td>".$row["firstName"]."</td>");
                    echo("<td>".$row["lastName"]."</td>");
                    echo("<td>".$row["address"]."</td>");
                    echo("<td>".$row["email"]."</td>");
                    echo("<td>".$row["homePhone"]."</td>");
                    echo("<td>".$row["cellPhone"]."</td>");
                    echo("</tr>");
                  }
                  mysqli_free_result($result);
                }
              }

              mysqli_close($link);
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script>
      // for disabling form submissions if there are invalid fields
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>