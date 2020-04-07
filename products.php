<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <style>
      .card {
        transition: 0.3s;
      }

      .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
      }

      .container {
        padding: 2px 16px;
      }
    </style>

      <script>
        function updateRecentlyViewed(x){
          var items = localStorage.getItem('mostRecent');
          items.unshift(x);
          if(items.length >= 5){
            items = items.slice(0,5);
          }

          localStorage.setItem('mostRecent', items);
        }
      </script>

    <title>Products</title>
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
              <a class="nav-link active" href="products.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="news.php">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="users.php">Users</a>
            </li>
          </ul>
        </div>

        <?php
          session_start();

          if(isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"] === true) ){
            echo('
              <form method="post"> 
                <input type="submit" name="logout-button"
                        class="btn btn-dark" value="Logout" /> 
              </form> 
                  
            ');
          }

          function logout(){
            session_start();  // Initialize the session
            $_SESSION = array();  // Unset all of the session variables
            session_destroy();  // Destroy the session.
            header("location: index.php");  // Redirect to homepage
            exit;
          }

          if(array_key_exists('logout-button', $_POST)) { 
            logout(); 
          } 

        ?>
    </nav>

    <div>
      <h2>Products</h2>
      <div class='flex-container'>
          <?php
            require_once 'config.php';

            $sql = 'SELECT * FROM products';
            if($result = mysqli_query($link, $sql)){
              while($row = mysqli_fetch_assoc($result)){
                echo('
                <a href="product.php?name='.str_replace(' ','-',$row["name"]).'&index='.$row["productID"].'" onclick="updateRecentlyViewed('.$row["productID"].')">
                  <div class="card" style="width:18rem; margin:8px 6px">
                    <img src="'.$row["img1Url"].'" alt="..." height="200px" style="display: block; margin: 20px auto 0 auto">
                    <div class="card-body">
                      <h5 class="card-title" style="color: black">'.$row["name"].'</h5>
                      <a href="" class="btn btn-primary">'.$row["price"].'</a>
                    </div>
                  </div>
                </a>
                ');
              }
              mysqli_free_result($result);
            }
            mysqli_close($link);
          ?>
      </div>
    </div> 

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>