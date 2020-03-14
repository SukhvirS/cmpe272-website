<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">

    <style>
      .carousel{
        height: 500px;
        width: 40%;
        float: left;
      }

      .carousel-item{
        border: 0;
      }

      .carousel-inner{
        height: 400px;
        width: 400px;
      }

      .carousel-item{
        height: 400px;
        width: 400px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
      }

      .carousel img{
        height: 400px;
        width: 400px;
      }

      .carousel-control-prev-icon {
        height: 40px;
        width: 30px;
        background-image: url('./images/prev.png');
      }
      
      .carousel-control-next-icon {
        height: 40px;
        width: 30px;
        background-image: url('./images/next.png');
      }

      .product-name{
        text-align: center;
        padding: 0 0 20px 0;
        margin: 0 15vw;
        font-size: 3vw;
      }
    </style>

    <title>The Phone Company</title>
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

            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                echo('
                <form method="post"> 
                    <input type="submit" name="logout-button"
                            class="btn btn-dark" value="Logout" /> 
                </form>
                ');
            }

            function logout(){
                session_start();    // Initialize the session
                $_SESSION = array();    // Unset all of the session variables
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
      <div>
        <?php
            // $products = file('all_products.txt');
            $currentUrl = 'https://';
            $currentUrl .= $_SERVER['HTTP_HOST'];
            $currentUrl .= $_SERVER['REQUEST_URI'];
            $indexInURL = strpos($currentUrl, 'index') + 6;
            $index = substr($currentUrl, $indexInURL);
            $index = intval($index);

            require_once 'config.php';

            $sql = "SELECT * FROM products WHERE productID = '$index'";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($result);

            echo('
            <p class="product-name">'.$row['name'].'</p>
            <div>
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="'.$row['img1Url'].'" alt="First slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="'.$row['img2Url'].'" alt="Second slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="'.$row['img3Url'].'" alt="Third slide">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
              <div style="width: 50%; float: right">
                <p>'.$row['description'].'</p>
                <a href="#" class="btn btn-primary">'.$row['price'].'</a>
              </div>
            </div>
            ');

            mysqli_free_result($result);
            mysqli_close($link);

        ?>
      </div>
    </div>
    
    <script>
        if(window.screen.width < 800){
            document.body.style.padding = '0';
            document.getElementById('home-image').src = './images/iphone.png';
        }

    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>