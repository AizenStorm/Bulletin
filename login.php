<?php
    include "mysql_connection.php";

    session_start();

    $username="";
    $pwd="";

    $stmt=$conn->prepare("SELECT Username,Password FROM users WHERE Username=?;");
    $stmt->bind_param("s",$username);

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if(empty($_POST["username"]))
        {
            $error="Username can't be empty";
        }
        else
        {
            $username=$_POST["username"];
            $username=htmlspecialchars($username);
        }

        if(empty($_POST["pwd"]))
        {
            $error="Password can't be empty";
        }
        else
        {
            $pwd=$_POST["pwd"];
        }
    }

    $query="SELECT Username,Password FROM users WHERE Username='$username';";
    $out=$conn->query($query);
    $row=$out->fetch_assoc();

    if($out->num_rows==0)
    {
        $error="No such user";
    }
    else
    {
       
        $original_pwd=$row["Password"];
        if($pwd!=$original_pwd)
        {
            $error="Credentials don't match";
        }
        else
        {
            #session_register("username");
            $_SESSION["login_user"]=$username;
            header("location: bulletin.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            #container{
                position: relative;
                border: 2px solid lightgrey;
                border-radius: 10px;
                padding: 20px;
                text-align: center;
                left: 400px;
                top: 50px;
                width: 400px;
            }
            
            .txt{
                height: 50px;
                border: 3px solid lightblue;
                border-radius: 10px;
                width:400px; 
                outline: none;
                font-size:20px;
                padding: 5px;
                color: #b36767;
            }
            
            input[type="submit"]
            {
                height: 50px;
                outline: none;
                font-size: 20px;
                color: orange;
                padding: 10px;
                border: 2px solid lightblue;
                border-radius: 10px;
                background-color: white;
                cursor: pointer;
            }
            
            input[type="submit"]:hover{
                border-color: orange;
                color: red;
            }
            
            button{
                height: 50px;
                outline: none;
                font-size: 20px;
                color: orange;
                padding: 10px;
                border: 2px solid lightblue;
                border-radius: 10px;
                background-color: white;
                cursor: pointer;
            }
            
            button:hover{
                border-color: orange;
                color: red;
            }
</style>
        
    </head>
    <body>
        <div id="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <input type="text" name="username" class="txt" placeholder="Username"><br><br><br>
                <input type="Password"  name="pwd" class="txt" placeholder="Password"><br><br><br><br>
                <input type="submit" value="Log In"><br><br>
            </form>
            <a href="register.php"><button>Register</button></a>
        </div>
    </body>
</html>
