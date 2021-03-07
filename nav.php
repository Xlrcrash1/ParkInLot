<div class = "navigation">
    <a class="btn btn-primary" href="index.php" role="button">Home</a>

    <div class="dropdown">

        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

            Welcome <?php    echo"{$_SESSION['firstName']}"    ?>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

            <a class="dropdown-item" href="profile.php">View Profile</a>
            <a class="dropdown-item" href="logout.php">Log Out</a>
        </div>
    </div>
</div>