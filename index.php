<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">

    <style>
      .flex-container{
          overflow-x: auto;
      }

      .flex-container::-webkit-scrollbar {
          display: none;
      }

      .card {
          flex: 0 0 18rem;
          margin:8px 6px;
          transition: 0.3s;
      }

      .card:hover {
          box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
      }
    </style>

    <script>
        var items = JSON.parse(localStorage.getItem('mostRecent'));

        function updateRecentlyViewed(x){
          if(items == null){
            items = [x];
            localStorage.setItem('mostRecent', JSON.stringify(items));
          }
          else{
            if(items.includes(x)){
              const index = items.indexOf(x);
              if(index > -1){
                items.splice(index, 1);
              }
            }
            items.unshift(x);
            if(items.length > 5){
              items = items.splice(0,5);
            }
            localStorage.setItem('mostRecent', JSON.stringify(items));
            createCookie('mostRecentItemsCookie', JSON.stringify(items),'10');
          }
        }

        function createCookie(name,value,days) {
            if (days) {
                var date = new Date();
                date.setTime(date.getTime()+(days*24*60*60*1000));
                var expires = "; expires="+date.toGMTString();
            }
            else var expires = "";
            document.cookie = escape(name) + "=" +  escape(value) + expires + "; path=/"; 
        }
      </script>

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
              <a class="nav-link active" href="index.php">Home</a>
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
      <img id='home-image' src="./images/phones.png" alt="image" width="100%">  
      <br>
      <br>
      <br>
      <div>
        <h2>Most recently viewed items:</h2>
        <div class='flex-container'>
          <?php
            require_once 'config.php';

            $recentItems = json_decode($_COOKIE['mostRecentItemsCookie']);

            foreach($recentItems as $key => $value){
              $sql = "SELECT * FROM products WHERE productID = $value";
              if($result = mysqli_query($link, $sql)){
                while($row = mysqli_fetch_assoc($result)){
                  echo('
                  <a href="product.php?name='.str_replace(' ','-',$row["name"]).'&index='.$row["productID"].'" onclick="updateRecentlyViewed('.$row["productID"].')">
                    <div class="card">
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
            }
          ?>
          
        </div>
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