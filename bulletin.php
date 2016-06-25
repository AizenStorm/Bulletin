<?php
    include "session.php";

    $username=$session_user;
    $access_level=$session_row["Access_level"];

    if($access_level=='viewer')
    {
        $show_addpost="style='display:none'";
    }
    else
    {
        $show_addpost="";
    }

    if($access_level=='admin')
    {
        $show_delete="";
        $show_admin_panel="";
    }
    else
    {
        $show_delete="style='display:none'";
        $show_admin_panel="style='display:none'";    
    }

    $name="joy";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            .posts{
                position: relative;
                border-radius: 10px;
                margin: 5px;
                width: 700px;
                left: 300px;
                background-color: #fcda2a;
                padding: 10px;
                padding-bottom: 1px;
            }
            
            .btn{
                height: 50px;
                outline: none;
                font-size: 15px;
                color: white;
                padding: 5px;
                border: none;
                background-color: orange;
                cursor: pointer;
            }
            
            .btn:hover{
                background-color: black;
                color: yellow;
            }
            
            #add_post{
                position: relative;
                margin-right:50px;
                margin-left: 30px; 
            }
            
            #admin_panel{
                position: relative;
                margin-left: 50px;
                margin-right: 50px;
            }
            
            #sign_out{
                position: relative;
                left: 650px;
            }
            
            h1{
                text-align: center;
            }
            
            .post_text{
                background-color: white;
            }
            
</style>
    </head>
    <body>
        
        <div style="background-color: orange;height: 50px;margin-right: 0px;">
            <span style="margin-left: 30px;">
                Logged in as <?php echo $username?>
            </span>

            <span <?php echo $show_addpost;?>>
                <a href="addPost.php"><button class="btn" id="add_post">Add Posts</button></a>
            </span>

            <span <?php echo $show_admin_panel;?>>
                <a href="admin_panel.php"><button class="btn" id="admin_panel">Admin Panel</button></a>
            </span>

            <span>
                <a href="signout.php"><button class="btn" id="sign_out">Sign Out</button> </a>
            </span>
        </div>

        <div>
            <h1>BULLETIN</h1>
        </div>

        <div>
            <?php
                $sql="SELECT * FROM posts ORDER BY Id DESC;";
                $out=$conn->query($sql);
                
                while($row=$out->fetch_assoc())
                {
                    echo "<div class='posts'>
                            <div>
                                By <b>".$row["Username"]."</b>
                            </div><br>
                            <div class='post_text'>
                                <b>".$row["Post"]."</b>
                            </div><br><br>"."
                            <div ".$show_delete.">
                                <form action='delete_post.php' method='get'>
                                    <input type='text' name='id' value='".$row["Id"]."' style='display:none'>
                                    <input type='image' src='delete.jpg' alt='submit' style='height:30px;width:30px;border-radius:10px;'></input>
                                </form>
                            </div>
                           </div><br><br>";
                }
            ?>
        </div>
        <script> 
        </script>
        
    </body>
</html>
