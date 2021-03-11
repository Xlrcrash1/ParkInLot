<!DOCTYPE = HTML>
<html>
<head>
    <title>Register</title>
    <link rel = 'stylesheet' type = 'text/css' href = './CSS/style.css'>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
        include('nav.php');
        // require('SQLconnect.php');
        include('./CSS/bootStrap.html');
    ?>
</head>
<body>
    <h1>Register for ParkInLot</h1>
    <h4>Please upload a photo to complete your registration</h4>

    <form action="upload.php" enctype="multipart/form-data" method="POST">
        Choose Image : <input name="img" size="35" type="file"/><br/>
        <input type="submit" name="submit" value="Upload"/>
    </form>

</body>
</html>