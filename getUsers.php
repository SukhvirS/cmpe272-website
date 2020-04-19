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
    $allUsers = '';
    $count = 1;

    if($result = mysqli_query($link, $sql)){
        while($row = mysqli_fetch_assoc($result)){
            // echo("<tr>");
            echo($row["firstName"]);
            echo(",");
            echo($row["lastName"]);
            echo(",");
            echo($row["address"]);
            echo(",");
            echo($row["email"]);
            echo(",");
            echo($row["homePhone"]);
            echo(",");
            $allUsers += $row['firstName'].',';
            $allUsers += $row['lastName'].',';
            $allUsers += $row['address'].',';
            $allUsers += $row['email'].',';
            $allUsers += $row['homePhone'].',';
            $allUsers += $row['cellPhone'].',';
            // echo("<th scope='row'>".$row["customerID"]."</th>");
            // echo("<td>".$row["firstName"]."</td>");
            // echo("<td>".$row["lastName"]."</td>");
            // echo("<td>".$row["address"]."</td>");
            // echo("<td>".$row["email"]."</td>");
            // echo("<td>".$row["homePhone"]."</td>");
            // echo("<td>".$row["cellPhone"]."</td>");
            // echo("</tr>");
          }
        mysqli_free_result($result);
    }

    mysqli_close($link);
    // echo($allUsers);
?>