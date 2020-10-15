<?php

    //SQL connect
    //Tony Cervantes
 
 
    //Connect to database
    $server =  'localhost';
    $user = 'tcervantes';
    $password = 'Tony101677';
    $database = 'tcervantes';
    $db = new mysqli($server, $user, $password, $database);
    // oop $obj->member
 
    if ($db->connect_error){
        
        exit("Bad Connection\n");
    }
    else{
 
     echo "We are connected<br>";
    }
 
    //GLOBAL_VAR $db////////////////////

?>
