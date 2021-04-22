<!DOCTYPE = HTML>
<html>
<head>
        <title>Register</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="./CSS/dist/css/style.css">
        <link rel = 'stylesheet' type='text/css' href = './CSS/color_palette.css'>
        <link rel = 'stylesheet' type='text/css' href = './CSS/type_scale.css'>
        <link rel = 'stylesheet' type='text/css' href = './CSS/style.css'>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
        // require('SQLconnect.php');
        // include('./CSS/bootStrap.html');
    ?>
</head>
<body>
    
    <div class='container'>
        <div class="row">
            <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <center>
                    <a href="./login.php">
                        <img src = './Images/ParkInLot_Logo_Blue.png' class='logo_medium'>
                    </a>
                    </center>
                </div>
            <div class="col-xs-0 col-lg-4 side"></div>
        </div>

        

        <!-- upload an image header -->
        <div class="row">
            <div class="col-xs-0 col-lg-4 side"></div>
            <div class="col main">
                <h1 class="register_title">Upload an image of your car</h1>
            </div>
            <div class="col-xs-0 col-lg-4 side"></div>
        </div>       
        <!-- <h1>Register for ParkInLot</h1>
        <h4>Please upload a photo to complete your registration</h4> -->

        <div class='register_box'>
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <form action="upload.php" enctype="multipart/form-data" method="POST">
                        <h4>Choose Image:</h4>
                        <input name="img" size="35" type="file"/><br/>
                        <br><br>
                        <input type="submit" class="btn btn-outline" name="submit" value="Upload"/>
                    </form>                        
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

        </div> 
    </div>

</body>
</html>