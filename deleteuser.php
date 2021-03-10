
<?php
    require('SQLconnect.php');
    $userName = $_POST['userName'];
    
    // Sanitizing SQL query
    $sql = $db->prepare("DELETE FROM Users WHERE userName = ?");    
    $sql->bind_param('s', $userName);

    if($sql->execute()){
        echo "<div class ='alert alert-success'>User: $userName has been deleted</div>";
        echo "<div class ='alert alert-info'>You will be redirected in a few seconds.</div>";
    };
?>
