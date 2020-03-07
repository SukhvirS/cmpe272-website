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
              <a class="nav-link active" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="products.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="news.html">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contacts.php">Contacts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">About</a>
            </li>
          </ul>
        </div>

        <?php
          // Check if the user is logged in, if not then redirect him to login page
          if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

          }
          else{
            echo('
              <form method="post"> 
                <input type="submit" name="logout-button"
                        class="btn btn-outline-dark" value="Logout" /> 
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
            
            // Redirect to login page
            header("location: login.php");
            exit;
          }

          if(array_key_exists('logout-button', $_POST)) { 
            logout(); 
          } 
          
        ?>
    </nav>
    <div>
      <div class="home-body">
        <p>Find you next phone.</p>
        <img id='home-image' src="https://images.unsplash.com/photo-1556656793-08538906a9f8?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&h=500&q=60" alt="image" width="100%">  
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