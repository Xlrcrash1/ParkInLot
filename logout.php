<?php

session_start();

if ($_SESSION['active']){

    session_unset();
    session_destroy();
    
}
header('Location: index.php');
?>
