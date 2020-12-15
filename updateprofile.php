<!DOCTYPE = html>
<html>
    <head>
        <title><?php echo "{$_SESSION['firstName']}'s Profile</title>\n";?>
        <link rel = 'stylesheet' type = 'text/css' href = 'style.css'>
    </head>
    <body>
        <div class = 'dropdown'>
            <?php 
            echo "<button class = 'dropbtn'>Hi " . $_SESSION["firstName"] . "^</button>\n";?>
            <div class = 'dropdown-content'>
                <a href = 'index.php'>Home</a>
                <a href = 'logout.php'>Log Out</a>
            </div>
        </div>
        <form method = 'POST'>
            <?php
                echo "<h3>Update your Profile {$_SESSION['firstName']}!</h3>\n";
                echo "\t\t\t\t<h4>Updating your username will cause chats to be deleted.\n";
                echo "\t\t\t\t<h5>First Name: <input type = 'text' name = 'updateName' placeholder = {$_SESSION['firstName']}></input></h5>\n";
                echo "\t\t\t\t<h5>Last Name: <input type = 'text' name = 'updatelName' placeholder = {$_SESSION['lastName']}></input></h5>\n";
                echo "\t\t\t\t<h5>Email: <input type = 'email' name = 'updateEmail' placeholder = {$_SESSION['email']}></input></h5>\n";
                echo "\t\t\t\t<h5>UserName: <input type = 'text' name = 'updateUserName' placeholder = {$_SESSION['userName']}></input></h5>\n";
            ?>
            <button class = 'update' type = 'submit'>Update Profile</button>
        </form>

        <?php
            $updateName = $_POST['updateName'];
            $updatelname = $_POST['updatelName'];
            $updateEmail = $_POST['updateEmail'];
            $updateUserName = $_POST['updateUserName'];

            //echo "updateName = $updateName and updateEmail = $updateEmail and updateUserName = $updateUserName\n";

            if (empty($_POST['updateName']) and empty($_POST['updatelName']) and empty($_POST['updateEmail']) and empty($_POST['updateUserName'])){

            //echo "Nothing to Update\n";
            }

            if (!empty($_POST['updateName'])){
                //echo "update name is set\n";
                $sql = "update Users set firstName = '{$_POST['updateName']}' where userName = '{$_SESSION['userName']}'";
                //echo $sql;
                $db->query($sql);
                //echo "Name has been updated to {$_POST['updateName']}\n<br><br>";
                //echo "session name: {$_SESSION['name']}\n";
                        
                $_SESSION['firstName'] = $_POST['updateName'];
                header('Location: profile.php');
                echo "Name has been updated to {$_POST['updateName']}\n<br><br>";
                //echo "session name: {$_SESSION['name']}\n";
            }

            if (!empty($_POST['updatelName'])){

                //echo "update name is set\n";
                $sql = "update Users set lastName = '{$_POST['updatelName']}' where userName = '{$_SESSION['userName']}'";
                //echo $sql;
                $db->query($sql);
                        
                //echo "Name has been updated to {$_POST['updateName']}\n<br><br>";
                //echo "session name: {$_SESSION['name']}\n";
                $_SESSION['lastName'] = $_POST['updatelName'];

                header('Location: profile.php');
                echo "Last Name has been updated to {$_POST['updatelName']}\n<br><br>";
                        
                //echo "session name: {$_SESSION['name']}\n";
            }        
            if (!empty($_POST['updateEmail'])){
                //echo "update email is set\n";
                $sql = "update Users set email = '{$_POST['updateEmail']}' where userName = '{$_SESSION['userName']}'";
                //echo $sql;
                $db->query($sql);
                //echo "Email has been updated to {$_POST['updateEmail']}\n<br><br>";
                $_SESSION['email'] = $_POST['updateEmail'];
                header('Location: profile.php');
                echo "Email has been updated to {$_POST['updateEmail']}\n<br><br>";
            }
                    
            if (!empty($_POST['updateUserName'])){
                //echo "session username= {$_SESSION['username']}\n";
                //echo "update username is set\n";
                $sql = "update Users set userName = '{$_POST['updateUserName']}' where userName = '{$_SESSION['userName']}'";
                //echo "sql statement: $sql\n";
                $db->query($sql);
                //echo "Username has been updated to {$_POST['updateUserName']}\n<br><br>";
                //header('Location: profile.php');
                $_SESSION['userName'] = $_POST['updateUserName'];
                header('Location: profile.php');
                echo "UserName has been updated to {$_POST['updateUserName']}\n<br><br>";
            }?>
<div class = 'car'>
        Car Information
            <form method = 'POST'>
                <?php
                    echo "<h5> Make: <input type = 'text' name = 'updateMake' placeholder = {$_SESSION['make']}></input></h5>\n";
                    echo "\t\t\t\t<h5> Model: <input type = 'text' name = 'updateModel' placeholder = {$_SESSION['model']}></input></h5>\n"; 
                    echo "\t\t\t\t<h5> Year: <input type = 'text' name = 'updateYear' placeholder = {$_SESSION['year']}></input></h5>\n"; 
                    echo "\t\t\t\t<h5> Color: <input type = 'text' name = 'updateColor' placeholder = {$_SESSION['color']}></input></h5>\n";
                    echo "\t\t\t\t<h5> Last 4 of License Plate: <input type = 'text' name = 'updateLicensePlate' placeholder = {$_SESSION['licensePlate']}></input></h5>\n";
                    echo "\t\t\t\t<h5> Picture: <input type = 'text' name = 'updatePhoto' placeholder = {$_SESSION['photo']}></input></h5>\n";  
                ?>
            <button class = 'update' type = 'submit'>Update Profile</button>
            </form>
        </div>
        <?php
            $updateMake = $_POST['updateMake'];
            $updateModel = $_POST['updateModel'];
            $updateYear = $_POST['updateYear'];
            $updateColor = $_POST['updateColor'];
            $updateLicensePlate = $_POST['updateLicensePlate'];
            $updatePhoto = $_POST['updatePhoto'];

            if (empty($_POST['updateMake']) and empty($_POST['updateModel']) and empty($_POST['updateYear']) and empty($_POST['updateColor']) and empty($_POST['updateLicensePlate']) and empty($_POST['updatePic'])){
            }
            if (!empty($_POST['updateMake'])){
                $sql = "UPDATE Users SET make = '{$_POST['updateMake']}' WHERE userName = '{$_SESSION['userName']}'";
                $db->query($sql);
                $_SESSION['make'] = $_POST['updateMake'];
                header('Location:profile.php');
                echo "Make has been updated to {$_POST['updateMake']}\n<br><br>";
            }
            if (!empty($_POST['updateModel'])){
                $sql = "UPDATE Users SET model = '{$_POST['updateModel']}' WHERE userName = '{$_SESSION['userName']}'";
                $db->query($sql);
                $_SESSION['model'] = $_POST['updateModel'];
                header('Location:profile.php');
                echo "Model has been updated to {$_POST['updateModel']}\n<br><br>";
            }
            if (!empty($_POST['updateYear'])){
                $sql = "UPDATE Users SET year = '{$_POST['updateYear']}' WHERE userName = '{$_SESSION['userName']}'";
                $db->query($sql);
                $_SESSION['year'] = $_POST['updateYear'];
                header('Location:profile.php');
                echo "Year has been updated to {$_POST['updateYear']}\n<br><br>";
            }
            if (!empty($_POST['updateColor'])){
                $sql = "UPDATE Users SET color = '{$_POST['updateColor']}' WHERE userName = '{$_SESSION['userName']}'";
                $db->query($sql);
                $_SESSION['color'] = $_POST['updateColor'];
                header('Location:profile.php');
                echo "Color has been updated to {$_POST['updateColor']}\n<br><br>";
            }
            if (!empty($_POST['updateLicensePlate'])){
                $sql = "UPDATE Users SET licensePlate = '{$_POST['updateLicensePlate']}' WHERE userName = '{$_SESSION['userName']}'";
                $db->query($sql);
                $_SESSION['licensePlate'] = $_POST['updateLicensePlate'];
                header('Location:profile.php');
                echo "License Plate has been updated to {$_POST['updateLicensePlate']}\n<br><br>";
            }
            if (!empty($_POST['updatePhoto'])){
                $sql = "UPDATE Users SET carPhoto = '{$_POST['updatePhoto']}' WHERE userName = '{$_SESSION['userName']}'";
                $db->query($sql);
                $_SESSION['photo'] = $_POST['updatePhoto'];
                header('Location:profile.php');
                echo "Car Photo has been updated to {$_POST['updatePhoto']}\n<br><br>";
            }

        ?>

        <div class = 'updatePassword'>
            <button class = 'accordion'>Change Password</button>
            <div class = 'panel'>
                <form method = 'POST'>
                    <h5>Current Password: <input type = 'password' name = 'current_password'></input>
                    <h5>New Password: <input type = 'password' name = 'new_password'></input>
                    <h5>Confirm Password: <input type = 'password' name = 'confirm_password'></input><br>
                    <br>
                    <button class = 'update' type = 'submit'>Update Password</button>
                </form>
            </div>
        </div>
        <?php
            //echo "currentPassword = {$_POST['current_password']} and newpassword = {$_POST['new_password']} and confirm_password = {$_POST['confirm_password']}\n";
            if (!empty($_POST['current_password']) and !empty($_POST['new_password']) and !empty($_POST['confirm_password'])){
                $current_password = $_POST['current_password'];
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];
            
            //echo "currentPassword = {$_POST['current_password']} and newpassword = {$_POST['new_password']} and confirm_password = {$_POST['confirm_password']}\n";

            if ($new_password == $confirm_password){
                echo "passwords matched\n";
                $sql = "select * from Users where userName = '{$_SESSION['userName']}'";
                    //echo $sql;

                if ($res = $db->query($sql)){

                //echo "sql statement query successfull\n";
                    $row = $res->FETCH_ASSOC();

                    $currentPassword = $row['password'];

                    echo "current password: $currentPassword\n";

                    if(password_verify($current_password, $row['password'])) {
                    // if ($currentPassword == $current_password){
                        echo "echo password matched sql password\n";
                        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
                        $sql = "UPDATE Users SET password = '$hashedPassword' WHERE userName = '{$_SESSION['userName']}'";
                        $db->query($sql);
                        //echo "sql: $sql";
                        header('Location: profile.php');
                        echo "password has been updated\n";
                    }
                    else{
                        echo "Sorry, your current password is incorrect\n";
                        }
                    }
                }
            else{
                echo "passwords did not match\n";
                }
            }?>
        <script>
            var acc = document.getElementsByClassName('accordion');
            var i;
            for (i = 0; i < acc.length; i++){
                acc[i].addEventListener('click', function(){
/*Toggle between adding and removing the 'active' class, to highlight the button that controls the panel*/
                    this.classList.toggle('active');
/*Toggle between hiding and showing the active panel */
                    var panel = this.nextElementSibling;
                    if (panel.style.display === 'block'){
                        panel.style.display = 'none';
                    }
                    else{
                        panel.style.display = 'block';
                    }
                });
            }
        </script>
        <br><br><br>

        <div class = 'delete_account'>
            <button class = 'delete_btn' onclick = 'deleteAccount()'>Delete Account</button>
            <p id = 'delete_check'></p>
        </div>
        <script>
            function deleteAccount()
            {
                var txt;
                var r = confirm('Are you sure you want to delete your account?');
                if (r == true){
            //$sql = "delete from Users where email = '{$_SESSION['email']}';";
            //$db->query($sql);
            //$_SESSION['active'] = false;
            //////////////////////////////////////////////////////////////////////////////////////////////////////////
            //echo "          txt = $sql;\n";
            //echo "          txt = 'userName = {$_SESSION['userName']}';\n";
                    txt = 'Account deleted';
                    setTimeout(location.reload.bind(location), 50000);
                }
                else{
                    txt = 'Account deletion aborted';
                }
                document.getElementById('delete_check').innerHTML = txt;
            }
        </script>
    </body>
</html>
