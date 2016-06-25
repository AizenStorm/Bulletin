<?php
    include "mysql_connection.php";

    $sql="CREATE TABLE users
            (Username VARCHAR(15) PRIMARY KEY NOT NULL,
            Password VARCHAR(16) NOT NULL,
            Fullname VARCHAR (20) NOT NULL,
            Access_level VARCHAR(7));
            ";
    if($conn->query($sql))
        echo "users table created <br>";
    else
        echo "couldn't create users table...".$conn->error."<br>";

    $sql2="CREATE TABLE posts
            (Username VARCHAR(15) NOT NULL,
            Post TEXT,
            Id INT(3) PRIMARY KEY AUTO_INCREMENT);
            ";

    if($conn->query($sql2))
        echo "posts table created<br>";
    else
        echo "Couldn't create posts table...".$conn->error."<br>";

    $sql3="INSERT INTO users VALUES ('admin','adminisgod','admin','admin');";

    if($conn->query($sql3))
        echo "Initial admin created<br>";
    else
        echo "Couldn't initial admin...".$conn->error."<br>";
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <a href="login.php"><button>Login Page</button></a>
    </body>
</html>
