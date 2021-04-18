<!DOCTYPE = HTML>
<html>
<head>
<title>ParkInLot</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/dist/css/style.css">
        <link rel = 'stylesheet' type='text/css' href = '../CSS/color_palette.css'>
        <link rel = 'stylesheet' type='text/css' href = '../CSS/style.css'>
        <link rel = 'stylesheet' type='text/css' href = '../CSS/type_scale.css'>
</head>
<body>
    <?php
    session_start();
    if ($_SESSION['active'] == false){
        header('location: ../login.php'); exit();
    }elseif($_SESSION['active'] == true){
        require('../SQLconnect.php');
        include('./nav.php');
        include('../updatestatus.php');
        update_status($db, $_SESSION['userID'], 0);
        echo $_SESSION['statusCode'];
    ?>

    <?php
    }
    include('../javaScript/javaScript.html')
    ?>
</body>

</html>