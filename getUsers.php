<?php
    // session_start();

    // if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    //     header("location: login.php");
    //     exit;
    // }
    // else{
    //     $redirectToGetUsers = True;
    // }

    require_once('config.php');

    $sql = "SELECT * FROM customers";
    $allUsers = '';
    $count = 1;

    if($result = mysqli_query($link, $sql)){
        while($row = mysqli_fetch_assoc($result)){
            $allUsers .= $row['firstName'].'+';
            $allUsers .= $row['lastName'].'+';
            $allUsers .= $row['address'].'+';
            $allUsers .= $row['email'].'+';
            $allUsers .= $row['homePhone'].'+';
            $allUsers .= $row['cellPhone'].'+';
          }
        mysqli_free_result($result);
    }

    mysqli_close($link);
    echo($allUsers);
?>