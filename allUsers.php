<?php
    $data = array(
        "USERNAME" => "admin",
        "PASSWORD" => "admin",

    );

    $ch = curl_init("http://cmpe272.nicolas-hanout.com/getUsers.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $nicolasUsers = curl_exec($ch);
    curl_close($ch);

    $ch = curl_init("http://masonqian.com/getUsers.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $masonUsers = curl_exec($ch);
    curl_close($ch);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="main.css">

        <title>All Users</title>
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
        <!-- <div style="margin: 10px 10px 0 10px">
            <h2 style="float: left; margin: 0; padding: 0 0 0 6px">Users (of all marketplaces)</h2>
            &nbsp;&nbsp;-&nbsp;&nbsp;
            <a href="users.php">Users</a>
        </div> -->


        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link" href="users.php">Users (The Phone Company)</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="">All Users (All marketplaces)</a>
          </li>
        </ul>

        <br>
        <br>

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
                $count = 1;

                require_once('config.php');

                $sql = "SELECT * FROM customers";

                if($result = mysqli_query($link, $sql)){
                    while($row = mysqli_fetch_assoc($result)){
                        echo("<tr>");
                        echo("<th scope='row'>".$count."</th>");
                        echo("<td>".$row["firstName"]."</td>");
                        echo("<td>".$row["lastName"]."</td>");
                        echo("<td>".$row["address"]."</td>");
                        echo("<td>".$row["email"]."</td>");
                        echo("<td>".$row["homePhone"]."</td>");
                        echo("<td>".$row["cellPhone"]."</td>");
                        echo("</tr>");
                        $count += 1;
                      }
                    mysqli_free_result($result);
                }
                mysqli_close($link);

                $ar = explode("|", $nicolasUsers);
                $ar = array_splice($ar, 0, count($arr)-2);
                for($i = 0; $i < count($ar); $i+= 6){
                    echo("<tr>");
                    echo("<th scope='row'>".$count."</th>");
                    echo("<td>".$ar[$i]."</td>");
                    echo("<td>".$ar[$i+1]."</td>");
                    echo("<td>".$ar[$i+2]."</td>");
                    echo("<td>".$ar[$i+3]."</td>");
                    echo("<td>".$ar[$i+4]."</td>");
                    echo("<td>".$ar[$i+5]."</td>");
                    echo("</tr>");
                    $count += 1;
                }
                $ar = explode("|", $masonUsers);
                // $ar = array_splice($ar, 0, count($arr)-2);
                print_r($ar);
                echo('0'.$ar[0]);
                echo('-1.'.$ar[1]);
                echo('-2.'.$ar[2]);
                echo('-3.'.$ar[3]);
                echo('-4.'.$ar[4]);
                echo('-5.'.$ar[5]);
                // for($i = 0; $i < count($ar); $i+= 6){
                //     echo("<tr>");
                //     echo("<th scope='row'>".$count."</th>");
                //     echo("<td>".$ar[$i]."</td>");
                //     echo("<td>".$ar[$i+1]."</td>");
                //     echo("<td>".$ar[$i+2]."</td>");
                //     echo("<td>".$ar[$i+3]."</td>");
                //     echo("<td>".$ar[$i+4]."</td>");
                //     echo("<td>".$ar[$i+5]."</td>");
                //     echo("</tr>");
                //     $count += 1;
                // }
            ?>
            
          </tbody>
        </table>
      </div>
    </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        
    </body>
</html>