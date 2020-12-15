<!Doctype>
<html lang = 'en'>

    <head>
    
        <title>DataBase Data</title>

        <?php
            session_start();

            if ($_SESSION['active'] && $_SESSION['access'] > 1){
        ?>

    </head>
    <body>
    
        <p>DataBase Tables: <?php $_POST['Users'];?></p>
    </body>

</html>

                <?php
                }else{

                    header('location: login.php'); 
                    exit();
                }
                ?>