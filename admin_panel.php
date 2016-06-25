<?php
    include "session.php";

    $sql="SELECT * FROM users;";
    $out=$conn->query($sql);

    $username=$session_user;

    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            table tr td{
                margin: 5px;
                padding: 2px;
                width:300px; 
            }
            
            .upgrade_btn{
                margin-right: 10px;
                text-align: center;
                margin-left: 10px;
                cursor: pointer;
            }
            
            .downgrade_btn{
                text-align: center;
                cursor: pointer;
            }
</style>
    </head>
    <body>
        <div>
            <?php
                echo "<table><tr><td>Username</td><td>Name</td><td>Access Level</td><td>Change Access Level</td></tr>";
                while($row=$out->fetch_assoc())
                {
                    if($row["Access_level"]=="admin")
                    {
                        $up_disabled="disabled";
                        $down_disabled="disabled";
                    }
                    else if($row["Access_level"]=="viewer")
                    {
                        $up_disabled="";
                        $down_disabled="disabled";
                    }
                    else
                    {
                        $up_disabled=$down_disabled="";
                    }

                    echo "<tr>
                              <td>".$row["Username"]."</td>
                              <td>".$row["Fullname"]."</td>
                              <td>".$row["Access_level"]."</td>
                              <td><form method='get'>
                                  <input type='text' value='".$row["Username"]."' name='username' style='display:none'>
                                  <button class='upgrade_btn' formaction='level_up.php' ".$up_disabled."><b>+</b></button>
                                  <button class='downgrade_btn' formaction='level_down.php' ".$down_disabled."><b>-</b></button>
                                  </form>
                              </td>
                          </tr>";
                }
                echo "</table>"
            ?>
        </div>
        <div>
            <a href="bulletin.php"><button>Back to Bulletin</button></a>
        </div>
    </body>
</html>
