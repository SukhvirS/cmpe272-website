<?php

    require_once 'config.php';

    $currentUrl = 'https://';
    $currentUrl .= $_SERVER['HTTP_HOST'];
    $currentUrl .= $_SERVER['REQUEST_URI'];
    echo('url:'.$currentUrl);
    echo("<br>");
    
    $idIndex = strpos($currentUrl, 'id');
    echo("index of id:".$idIndex);
    echo("<br>");

    echo(substr($currentUrl, ($idIndex+3)));
    echo("<br>");

    $productID = intval(substr($currentUrl, ($idIndex+3)));

    $sql = "SELECT * FROM products WHERE productID = '$productID'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    echo($row['name']);

    // $index = substr($currentUrl, $indexInURL);
    // $index = intval($index);

    // $sql = "SELECT * FROM products WHERE productID = '$index'";
    // $result = mysqli_query($link, $sql);
    // $row = mysqli_fetch_assoc($result);

    // echo($row['name']);

?>