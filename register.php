<!DOCTYPE = HTML>
<html>
    <head>
        
        <title>Register</title>
        <?php   include("./CSS/bootStrap.html");    ?>
        <link rel = 'stylesheet' type = 'text/css' href = './CSS/style.css'>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    
    <body>

        <?php   include('nav.php');   
        
        require('SQLconnect.php');?>

        <h1>Register for ParkInLot</h1>
        <h4>Please complete all fields</h4>
        <br>
        <div class = 'register_box'>
    
            <form method = 'POST'>
        
                <h5>First Name: <input type = 'text' placeholder = 'Tony' name = 'firstName'></h5>
                <h5>Last Name: <input type = 'text' placeholder = 'Cervantes' name = 'lastName'></h5>
                <h5>UserName: <input type = 'text' placeholder = 'XLR8' name = 'userName'></h5>
                <h5>Email: <input type = 'email' placeholder = 'email@email.com' name = 'email'></h5>
                <h5>Password: <input type = 'password' placeholder = '*****' name = 'password'></h5>
                <h5>Confirm Password: <input type = 'password' placeholder = '*****' name = 'confirm_password'></h5>

                <h5>Make: <input type = 'text' placeholder = 'Toyota' name = 'make'></h5>
                <h5>Model: <input type = 'text' placeholder = 'GT86' name = 'model'></h5>
                <h5>Year: <input type = 'number' placeholder = '2017' name = 'year'></h5>
                <h5>Last 4 of LicensePlate: <input type = 'text' placeholder = 'C777' name = 'licensePlate'></h5>
                <h5>Color: <input type = 'text' placeholder = 'Grey' name = 'color'></h5>
                <div class='g-recaptcha' data-sitekey='6LcdvfkZAAAAANZYnLTRvlsXFYDtim_Kz33h16m5'></div>
                <button class = 'nav_btn' type = 'submit'>Create</button>
            </form>
        </div>
        <?php   include("./javaScript/javaScript.html"); ?>
    </body>
</html>

<!--<script>
    function checkCaptcha(){

        var response = grecaptcha.getResponse();
        if (response.length == 0){
        
            alert('Please verify you are human!')
            return false;\n}
        else{
            
            return true;
        }
    }
</script>-->

<?php
if (($_POST["g-recaptcha-response"] != '') && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['userName']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){

    //this converts the post parameters from HTML into PHP parameters as well as we sanatize it to avoid sql queries being interjected
    $firstName = htmlspecialchars(trim($_POST['firstName']));/////////////////ADD SANATIZATION
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $userName = htmlspecialchars(trim($_POST['userName']));/////////////////ADD SANATIZATION
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));/////////////////ADD SANATIZATION
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));

    $make = htmlspecialchars(trim($_POST['make']));/////////////////ADD SANATIZATION
    $model = htmlspecialchars(trim($_POST['model']));
    $year = htmlspecialchars(trim($_POST['year']));/////////////////ADD SANATIZATION
    $licensePlate = htmlspecialchars(trim($_POST['licensePlate']));
    $color = htmlspecialchars(trim($_POST['color']));


    //echo "name: $name , lastname: $lname, userName: $userName , email: $email , password: $password , confirm: $confirm_password, Make: $make, Model = $model, Year: $year, licenseplate: $licensePlate";
    
    if ($password == $confirm_password){

        $sql = $db->prepare("SELECT * FROM Users WHERE userName = ? OR email = ? OR licensePlate = ?");
        $sql->bind_param('sss', $userName, $email, $licensePlate);
        $sql->execute();
        //"select * from Users where userName = '$userName' or email = '$email' or licensePlate = '$licensePlate'";
        if ($res = $sql->get_result()){

            $row = $res->FETCH_ASSOC();
            
            $exists = '';
            
            if ($row['userName'] == $userName){

                $exists .= 'UserName taken<br>';
            }
            if ($row['email'] == $email){

                $exists .= 'Email already exists<br>';
            }
            if ($row['licensePlate'] == $licensePlate){

                $exists .= 'License Plate already exists<br>';
            }
            if ($row['userName'] == $userName or $row['email'] == $email or $row['licensePlate'] == $licensePlate){

                echo $exists;
            }
            else{
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                //echo "email or userName is not taken<br>\n";
                $sql = $db->prepare("INSERT INTO Users (firstName, lastName, userName, password, email, make, model, year, color, licensePlate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $sql->bind_param('ssssssssss', $firstName, $lastName, $userName, $hashedPassword, $email, $make, $model, $year, $color, $licensePlate);
                $sql->execute();
                $sql->close();
                // $sql = "insert into Users (firstName, lastName, userName, password, email, make, model, year, color, licensePlate) values('$name','$lname','$userName','$hashedPassword','$email', '$make', '$model', '$year', '$color', '$licensePlate');";
                // $db->query($sql);

                $_SESSION['active'] = false;
                $_SESSION['firstName'] = $name;
                $_SESSION['lastName'] = $lname;
                $_SESSION['access'] = "1";
                $_SESSION['email'] = $email;
                $_SESSION['userName'] = $userName;
                $_SESSION['make'] = $make;
                $_SESSION['model'] = $model;
                $_SESSION['year'] = $year;
                $_SESSION['color'] = $color;
                $_SESSION['licensePlate'] = $licensePlate;
                header('Location: carupload.php');

            }
        }
        //echo "passwords matched\n";
    }
    else{

        echo "Please try again, your passwords did not match\n";
    }

}
else{

    $error = 'You forgot to enter the following:<br><br>';
    if (empty($_POST['firstName'])){

        $error .= 'FirstNAME<br>';
    }
    if (empty($_POST['lastName'])){

        $error .= 'LastNAME<br>';
    }
    if (empty($_POST['userName'])){

        $error .= 'USERNAME<br>';
    }
    if (empty($_POST['email'])){

        $error .= 'EMAIL<br>';
    }
    if (empty($_POST['password'])){

        $error .= 'PASSWORD<br>';
    }
    if ( empty($_POST['confirm_password'])){

        $error .= 'CONFIRM PASSWORD<br>';
    }
    if (empty($_POST['make'])){

        $error .= 'Make<br>';
    }
    if (empty($_POST['model'])){

        $error .= 'model<br>';
    }
    if (empty($_POST['year'])){

        $error .= 'year<br>';
    }
    if (empty($_POST['color'])){

        $error .= 'color<br>';
    }
    if ( empty($_POST['licensePlate'])){

        $error .= 'LicensePlate<br>';
    }

    //echo "TEST that is nothing is posted\n";
    echo "$error\n";
}
?>
