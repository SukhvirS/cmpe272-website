<?php
    // session_start();

    // if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    //     header("location: login.php");
    //     exit;
    // }
    // else{
    //     header("location: getUsers.php");
    // }

    require_once('config.php');

    $sql = "SELECT * FROM customers";
    $result = '';
    $count = 1;

    if($result = mysqli_query($link, $sql)){
        // while($row = mysqli_fetch_assoc($result)){
        //     $result += $row["firstName"].',';
        //     $result += $row["lastName"].',';
        //     $result += $row["address"].',';
        //     $result += $row["email"].',';
        //     $result += $row["homePhone"].',';
        //     $result += $row["cellPhone"].',';
        //     echo($count."---");
        //     $count += 1;
        // }
        while($row = mysqli_fetch_assoc($result)){
            // echo("<tr>");
            echo($row["firstName"]);
            echo("<br>");
            echo($row["lastName"]);
            echo("<br>");
            echo($row["address"]);
            echo("<br>");
            echo($row["email"]);
            echo("<br>");
            echo($row["homePhone"]);
            echo("<br>");
            echo("<th scope='row'>".$row["customerID"]."</th>");
            echo("<td>".$row["firstName"]."</td>");
            echo("<td>".$row["lastName"]."</td>");
            echo("<td>".$row["address"]."</td>");
            echo("<td>".$row["email"]."</td>");
            echo("<td>".$row["homePhone"]."</td>");
            echo("<td>".$row["cellPhone"]."</td>");
            // echo("</tr>");
          }
        mysqli_free_result($result);
    }

    mysqli_close($link);
    echo($result);
?>