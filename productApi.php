<?php
    $currentUrl = 'https://';
    $currentUrl .= $_SERVER['HTTP_HOST'];
    $currentUrl .= $_SERVER['REQUEST_URI'];
    echo('url:'.$currentUrl);
    
    $indexInURL = strpos($currentUrl, 'index') + 6;
    $index = substr($currentUrl, $indexInURL);
    $index = intval($index);

    $sql = "SELECT * FROM products WHERE productID = '$index'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    echo($row['name']);

?>