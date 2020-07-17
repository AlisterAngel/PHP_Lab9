<?php
// check the url for a gamer_id parameter and store the value in a variable if we find one
    $gamer_id = $_POST['gamer_id'];
//Variables
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$age = $_POST['age'];
$typeOfGamer = $_POST['typeOfGamer'];
$game = $_POST['game'];

$ok = true;

if (empty($firstName)) {
    echo 'First Name is required<br />';
    $ok = false;
}

if (empty($lastName)) {
    echo 'Last Name is required<br />';
    $ok = false;
}

if (empty($age)) {
    echo 'Age is required<br />';
    $ok = false;
}
elseif (is_numeric($age) == false) {
    echo 'Age is invalid<br />';
    $ok = false;
}

if (empty($typeOfGamer)) {
    echo 'Type Of Gamer is required<br />';
    $ok = false;
}

if (empty($game)) {
    echo 'Game Name is required<br />';
    $ok = false;
}

if ($ok == true) {

//Connect
    try{
    require("db.php");

    if (empty($gamer_id)) {
        // set up the SQL INSERT command
        $sql = "INSERT INTO gamer (firstName, lastName, age, typeOfGamer, game) VALUES (:firstName, :lastName, :age, :typeOfGamer, :game)";
    }
    else {
        // set up the SQL UPDATE command to modify the existing gamer
        $sql = "UPDATE gamer SET firstName = :firstName, lastName = :lastName, age = :age, typeOfGamer = :typeOfGamer, game = :game WHERE gamer_id = :gamer_id";
    }
    $cmd = $db->prepare($sql);

//Bind
    // fill the gamer_id if we have one
    if (!empty($gamer_id)) {
        $cmd->bindParam(':gamer_id', $gamer_id, PDO::PARAM_INT);
    }
    $cmd->bindParam(':firstName', $firstName, PDO::PARAM_STR, 25);
    $cmd->bindParam(':lastName', $lastName, PDO::PARAM_STR, 25);
    $cmd->bindParam(':age', $age, PDO::PARAM_INT);
    $cmd->bindParam(':typeOfGamer', $typeOfGamer, PDO::PARAM_STR, 25);
    $cmd->bindParam(':game', $game, PDO::PARAM_STR, 100);

//Execute
    $cmd->execute();
    $db = null;
    }
    catch (Exception $e) {
        header('location:error.php');
    }

    echo "New Gamer has been saved!";
    header('location:view-gamers.php');
}else{
    echo "Gamer has not been saved. Please check input was valid.";
    header('location:gamer.php');
}