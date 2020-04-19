<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    else{
        header("location: getUsers.php");
    }

    require_once('config.php');

    $sql = "SELECT * FROM customers";
    $result = '';

    if($result = mysqli_query($link, $sql)){
        while($row = mysqli_fetch_assoc($result)){
            $result += $row['firstName'] + ',';
            $result += $row['lastName'] + ',';
            $result += $row['address'] + ',';
            $result += $row['email'] + ',';
            $result += $row['homePhone'] + ',';
            $result += $row['cellPhone'] + ',';
        }
        mysqli_free_result($result);
    }

    mysqli_close($link);
    $result = "test";
    echo($result);
?>