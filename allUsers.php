<?php
    $data = array(
        "USERNAME" => "admidn",
        "PASSWORD" => "admin",

    );

    $ch = curl_init("http://cmpe272.nicolas-hanout.com/login.php");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    echo $result;

?>