<?php

session_start();

if ($_SESSION['active'] == true){

    include "updateprofile.php";
}
else{
    
    header('Location: login.php');
}
?>
