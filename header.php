<?php ob_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php echo "<title>".$title_of_page."</title>";?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kognise/water.css@latest/dist/dark.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/ico" href="images/FrostBurnLogo.ico">
</head>
<body class="view">
<header>
    <nav>
        <ul>
            <?php

                if($register_required == "true") {
                    echo   '<li><a href="home.php">Home</a></li>
                            <li><a href="view-gamers.php">Gamers</a></li>
                            <li><a href="gamer.php">Add New Gamer</a></li>
                            <li><a href="logout-gamer.php">Logout</a></li>';
                }elseif(!empty($register_required)){
                    echo '<li><a href="view-gamers.php">Gamers</a></li>';
                    if($register_required == "register"||$register_required == "view"){
                        echo   '<li><a href="login.php">Login</a></li>';
                    }elseif($register_required == "login"||$register_required == "view"){
                        echo   '<li><a href="register.php">Register</a></li>';
                    }
                }
            ?>
        </ul>
    </nav>
</header>
<div class="adjust">