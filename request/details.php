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
        global $parkingLot, $pUserName, $pMake, $pModel, $pYear, $pColor, $pLicensePlate, $pCarPhoto;
        
        $parkingLot = $_POST['parkingLot'];
        $pUserName = $_POST['pUserName'];
        $pMake = $_POST['pMake'];
        $pModel = $_POST['pModel'];
        $pYear = $_POST['pYear'];
        $pColor = $_POST['pColor'];
        $pLicensePlate = $_POST['pLicensePlate'];
        $pCarPhoto = $_POST['pCarPhoto'];

        require('../SQLconnect.php');
        include('./nav.php');
        include('../updatestatus.php');
        update_status($db, $_SESSION['userID'], 0);
        // echo $_SESSION['statusCode'];
        ?>

<div class = 'container'>  

            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <h1 class="details_title_blue">You're paired with</h1>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>
            <!-- profile image -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <img src = <?php echo "'{$pCarPhoto}'";?>
                    <!-- alt='Car Photo' onerror="this.src='../Images/default.jpg';" class='profile_image'>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <!-- username -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <h1 class="profile_title">
                        <?php echo "{$pUserName}";?>
                    </h6>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <!-- car description -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <h6 class="profile_subtitle">
                        <?php echo "{$pColor} {$pYear} {$pMake} {$pModel}";?>
                        <br>
                        <?php echo "License Plate: {$pLicensePlate}";?>
                    </h6>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <!-- divider -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <hr class="divider">
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>
        </div>

        <br>
        <div class = 'container'>
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <h1 class="details_title_blue">Find your Parking Spot</h1>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <div id="map_display">
                    <?php include('../lotlocation.php');?>
                    </div>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

        </div>
        <?php
        // include('../lotlocation.php');
    ?>

    <?php
    }
    include('../javaScript/javaScript.html')
    ?>
</body>

</html>