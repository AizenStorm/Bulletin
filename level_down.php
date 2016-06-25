<?php
    include "session.php";

     if($_SERVER["REQUEST_METHOD"]=="GET")
     {
         $username=$_GET["username"];

         $sql="SELECT Access_level FROM users WHERE Username='$username';";
         $out=$conn->query($sql);
         $row=$out->fetch_assoc();
         $present_level=$row["Access_level"];
         $new_level="editor";

         if($present_level=="editor")
         {
             $new_level="viewer";
         }

         $sql2="UPDATE users SET Access_level='$new_level' WHERE Username='$username';";
         $conn->query($sql2);
     }

     header("location: admin_panel.php");
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
