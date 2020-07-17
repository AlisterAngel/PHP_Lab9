<?php
try{
    require_once("auth.php");
    // capture the selected movie_id from the url and store it in a variable with the same name
    $gamer_id = $_GET['gamer_id'];

    // connect
    $conn = new PDO('mysql:host=172.31.22.43;dbname=Riley200445643', 'Riley200445643', 'dol_0bh8Gy');

    // set up the SQL command
    $sql = "DELETE FROM gamer WHERE gamer_id = :gamer_id;";

    // create a command object so we can populate the movie_id value, the run the deletion
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':gamer_id', $gamer_id, PDO::PARAM_INT);
    $cmd->execute();

    //disconnect
    $conn = null;
}
catch (Exception $e) {
    header('location:error.php');
}
header('location:view-gamers.php');