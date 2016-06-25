<?php
    include "session.php";

    $username=$session_user;

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $text=validate($_POST["user_post"]);
        $sql="INSERT INTO posts (Username,Post) VALUES ('$username','$text');";

        if($conn->query($sql))
        {
            echo "done";
            header("location: bulletin.php");
        }
        else
            echo "<br>Couldn't Post";

    }

    function validate($data)
    {
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            textarea{
                
                border: 3px solid lightgrey;
                font-size: 15px;
                outline: none;
                padding: 10px;
            }
            
            input[type="submit"]
            {
                height: 30px;
                width: 80px;
                outline: none;
                font-size: 15px;
                color: black;
                padding: 5px;
                border: 2px solid black;
                border-radius: 5px;
                background-color: white;
                cursor: pointer;
            }
            
            input[type="submit"]:hover{
                border-color: green;
                background-color:white;
                color: orange;
            }
</style>
    </head>
    <body>
        <div style="font-size: 20px;">
            As <b><?php echo $username;?></b><br><br>
        </div>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <textarea name="user_post" rows=10 cols=100></textarea><br><br>
            <input type="submit" value="POST">
        </form>
    </body>
</html>
