<?php
    $servername="localhost";
    $username="joy";
    $password="password";
    $dbname="spiderdb";
    $conn=new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error)
        die("Connect Error: ".$conn->connect_error);
    else
        echo "connected<br>";
?>

