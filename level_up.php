<?php
    include "session.php";

     if($_SERVER["REQUEST_METHOD"]=="GET")
     {
         $username=$_GET["username"];
         echo $username;
         $sql="SELECT Access_level FROM users WHERE Username='$username';";
         $out=$conn->query($sql);
         $row=$out->fetch_assoc();
         $present_level=$row["Access_level"];
         $new_level="viewer";

         if($present_level=="editor")
         {
             $new_level="admin";
         }
         else if($present_level=="viewer")
         {
             $new_level="editor";
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
