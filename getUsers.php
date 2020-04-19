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
        while($row = mysqli_fetch_assoc($result)){
            // echo($row['firstName']);
            // echo($row['lastName']);
            // echo($row['address']);
            // echo($row['email']);
            // echo($row['cellPhone']);
            $result += $row["firstName"].',';
            $result += $row["lastName"].',';
            $result += $row["address"].',';
            $result += $row["email"].',';
            $result += $row["homePhone"].',';
            $result += $row["cellPhone"].',';
            echo($count."---");
            $count += 1;
        }
        // mysqli_free_result($result);
    }

    mysqli_close($link);
    echo($result);
?>