<?php   session_start();    ?>

<div class = "navigation">
    <div class="row">
        <div class="col-auto">
            <!-- <a class="btn btn-primary" href="index.php" role="button">Home</a> -->
            <a href="../index.php">
                <img src = '../Images/ParkInLot_Logo_Blue_Banner.png' class='logo_nav'>
            </a>
        </div>
        <div class="col-auto"></div>
        <div class="col">
            <div class="dropdown">
            <button class="btn btn-nav dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Welcome
                <?php
                    if ($_SESSION['active'] == false){
                        echo "Guest!\n";
                    }
                    else{
                        echo"{$_SESSION['firstName']}\n";
                    }
                ?>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                <?php
                    if ($_SESSION['active'] == false) {
                ?>
                    <a class="dropdown-item" href="../login.php">Sign In</a>
                    <a class="dropdown-item" href="../register.php">Register</a>
                <?php
                    }
                    else{
                ?>
                    <a class="dropdown-item" href="../profile.php">Update Profile</a>
                    <a class="dropdown-item" href="../logout.php">Log Out</a>
                <?php
                    }
                ?>
            </div>
            </div>
        </div>
    </div>
</div>
