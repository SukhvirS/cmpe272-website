<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!-- <link href="https://fonts.googleapis.com/css?family=Cinzel|Comfortaa|Montserrat|Noto+Serif+TC|Playfair+Display|Questrial|Simonetta|Work+Sans&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="main.css">

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
    <div>
      <div>
        <p id="product-name"></p>
        <?php
            $products = file('all_products.txt');
            $currentUrl = 'https://';
            $currentUrl .= $_SERVER['HTTP_HOST'];
            $currentUrl .= $_SERVER['REQUEST_URI'];
            $index = $currentUrl[strpos($currentUrl, 'index') + 6];
            echo('
            <img src="'.$products[$index+1].'"></img>"
            ');

        ?>
        <img src='' id='product-image'></img>
      </div>
    </div>
    
    <script>
        if(window.screen.width < 800){
            document.body.style.padding = '0';
            document.getElementById('home-image').src = './images/iphone.png';
        }

        window.onload = function(){
            function parseUrlParameter(param){
                var fullUrl = window.location.search.substring(1);
                var paramArray = fullUrl.split('&');
                
                for(let i = 0; i < paramArray.length; i++){
                    let currentParam = paramArray[i].split('=');
                    if(currentParam[0] == param){
                        return currentParam[1];
                    }
                }
            }
            document.getElementById('product-name').innerHTML = parseUrlParameter('name').split('-').join(' ');
            readTextFile('all_products.txt');
        }

    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>