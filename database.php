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
    </body>

</html>

                <?php
                }else{

                    header('location: login.php'); 
                    exit();
                }
                ?>