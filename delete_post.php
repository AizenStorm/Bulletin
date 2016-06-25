<?php
    include "session.php";

    if($_SERVER["REQUEST_METHOD"]=="GET")
    {
        $id=$_GET["id"];
        $sql="DELETE FROM posts WHERE Id='$id'";
        $conn->query($sql);
    }
    header("location: bulletin.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        
    </body>
</html>
