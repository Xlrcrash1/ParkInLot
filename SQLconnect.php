<?php

    //SQL connect
    //Tony Cervantes
 
 
    //Connect to database
    $server =  'localhost';
    $user = 'spstudios';
    $password = 'Rew3zdupxe';
    $database = 'spstudios';
    $db = new mysqli($server, $user, $password, $database);
    // oop $obj->member
 
    if ($db->connect_error){
        
        exit("Bad Connection\n");
    }
    else{
 
     //echo "We are connected<br>";
    }
    
    //GLOBAL_VAR $db////////////////////

?>
