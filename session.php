<?php
    include "mysql_connection.php";

    session_start();

    $session_user=$_SESSION["login_user"];

    $session_out=$conn->query("SELECT * FROM users WHERE Username='$session_user';");
    $session_row=$session_out->fetch_assoc();

    $session_login=$session_row["Username"];

    if(!isset($_SESSION["login_user"]))
    {
        header("location: login.php");
    }

?>
