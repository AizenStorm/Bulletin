<?php
    
    include "mysql_connection.php";

    session_start();

    $stmt = $conn->prepare("INSERT INTO users VALUES (?,?,?,?);");

    $username = $fullname = $username_error = $fullname_error = "";
    $pwd1 = $pwd2 = $pwd_error = "";
    $error = TRUE;
    $access_lvl="viewer";

    $stmt->bind_param("ssss",$username,$pwd1,$fullname,$access_lvl);

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if(empty($_POST["register_user"]))
        {
            $username_error = "Username can't be empty";
            $error = TRUE;
        } 
        else
        {
            $username = $_POST["register_user"];
            $username = validate($username);
            if(strlen($username)<4)
            {
                $username_error = "Username has to be longer than 4 characters";
                $error = TRUE;
            }
            else if(!preg_match("/^[a-zA-Z_]*$/",$username))
            {
                $username_error = "Invalid Format";
                $error = TRUE;
            }
            else
                $error=FALSE;
        }

        if(empty($_POST["register_pwd"]))
        {
            $pwd_error = "Please choose a Password";
            $error = TRUE;
        }
        else
        {
            $pwd1 = $_POST["register_pwd"];
            $pwd1 = htmlspecialchars($pwd1);
            if(strlen($pwd1)<6  || strlen($pwd1)>16)
            {
                $pwd_error = "Password should be 6-16 characters long";
                $error = TRUE;
            }
            else
            {
                $error=FALSE;
            }
        }

        $pwd2=$_POST["register_pwd_2"];
        if($pwd2!=$pwd1)
        {
            $pwd_error="Enter the same Password";
            $error=TRUE;
        }
        
        if(empty($_POST["register_name"]))
        {
            $fullname_error = "Please Enter your name";
            $error = TRUE;
        }
        else
        {
            $fullname=$_POST["register_name"];
            $fullname=validate($fullname);
            if(!preg_match("/^[a-zA-Z ]*$/",$fullname))
            {
                $fullname_error="Invalid Name";
                $error=TRUE;
            }
            else
            {
                $error=FALSE;   
            }
        }
        
    }

    if(!$error)
    {
        $stmt->execute();
        echo "successful";
        header("location: login.php");
    }

    function validate($data)
    {
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            span{
                color: red;
            }
            
            #container{
                position: relative;
                border: 2px solid lightgrey;
                border-radius: 10px;
                padding: 20px;
                text-align: center;
                left: 400px;
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
            
        </style>
    </head>
    <body>
        <div id="container">
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                    Username<br>
                    <input type="text" name="register_user" class="txt"><span>* <?php echo $username_error;?></span><br><br>
                    Password<br>
                    <input type="Password" name="register_pwd" id="pwd1" class="txt"><span>*</span><br><br>
                    Re-enter Password<br>
                    <input type="Password" name="register_pwd_2" id="pwd2" class="txt"><span>*<?php echo $pwd_error;?></span><br><br>
                    Full name<br>
                    <input type="text" name="register_name" class="txt"><span>* <?php echo $fullname_error;?></span><br><br>
                    <input type="submit" value="Sign Up">
            </form>
        </div>
        <?php
            echo $username."<br>".$fullname;
        ?>
    </body>
</html>
