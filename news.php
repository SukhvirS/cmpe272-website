<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">

    <title>News</title>
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
                <a class="nav-link active" href="news.php">News</a>
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
        <h2 style="padding: 0 0 0 16px">News</h2>

        <div id='loading'>
          <p>Loading articles...</p>
        </div> 
        <script>
          window.onload = function(){
            document.getElementById('loading').style.display = 'none';
          };
        </script>

        <script language="JavaScript" type="text/javascript">
          // Customize the widget by editing the fields below
          // All fields are required
      
          // Your Feedity RSS feed URL
          feedity_widget_feed = "http://www.gsmarena.com/rss-news-reviews.php3";
      
          // Number of items to display in the widget
          feedity_widget_numberofitems = "10";
      
          // Show feed item description (values: yes or no)
          feedity_widget_showdescription = "no";
      
          // Show feed item published date (values: yes or no)
          feedity_widget_showdate = "yes";
      
          // Widget box width (in px, pt, em, or %)
          feedity_widget_width = "100%";
      
          // Widget box background color in hex or by name (eg: #ffffff or white)
          feedity_widget_backcolor = "#ffffff";
      
          // Widget text & link color in hex or by name (eg: #000000 or black)
          feedity_widget_fontcolor = "#000000";
        </script>
        <script language="JavaScript" type="text/javascript" src="https://feedity.com/js/widget.js"></script>

        <p>All articles from the GSM Arena RSS feed</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>