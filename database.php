<!Doctype html>
<html lang = 'en'>

    <head>
    
        <title>DataBase Data</title>

        <?php
            session_start();

            if ($_SESSION['active'] && $_SESSION['access'] > 1){
        ?>

    </head>
    <body>
    
        <?php
            echo "POST: {$_POST['UsersTable']}<br>\n";
        ?>   

        <?php
            $sql = "select max(userID) from users";

            if ($res = $db->query($sql)){
                 
                //echo "succssful sql query<br>\n";
                $row = $res->FETCH_ASSOC();
                //echo "row check : {$row['chatNum']}<br>\n";
                
                $chatNum = $row['chatNum'];
                //echo "chatnum = $chatNum<br>\n";
            }
               

            for ($num = $chatNum; $num >= 1; $num--){
                 
                if ($_SESSION['access'] > 1){
                 
                    $sql = "{$_POST['UsersTable']}";
                    //echo "$sql";
                 
                    //echo "for loop $sql<br>\n";
                 
                    if ($res = $db->query($sql)){
                 
                        //echo "success<br>\n";
                 
                        $row = $res->FETCH_ASSOC();
                 
                        if($row['username']==$_SESSION['username']){
                 
                            echo "<div class = 'chatMessages'>\n";
                            echo "  <div class = 'chat_username'>\n";
                            echo "  {$row['firstName']} \n";
                            echo "  </div>\n";
                 
                            echo "  <div class = 'chat_chat'>\n";
                            echo "  {$row['userName']}\n";
                            echo "  </div>\n";
                 
                            echo "  <div class = 'chat_time'>\n";
                            echo "  {$row['password']}\n";
                            echo "  </div>\n";
                            echo "</div><br>\n";
                        }
                    }
                }
            }
                
        ?>

    </body>

</html>

                <?php
                }else{

                    header('location: login.php'); 
                    exit();
                }
                ?>