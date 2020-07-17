<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Saving Your Registration</title>
</head>
<body>
<?php
//get the form inputs
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;
$username_taken = false;

//validate the inputs
if(empty($username)){
    echo 'Username is Required<br/>';
    $ok = false;
}
if(empty($password)){
    echo 'Password is Required<br/>';
    $ok = false;
}
if($password != $confirm){
    echo 'Passwords do not match<br/>';
    $ok = false;
}

if($ok){
    //Check if username is already taken
    $db = new PDO('mysql:host=172.31.22.43;dbname=Riley200445643', 'Riley200445643', 'dol_0bh8Gy');

    $sql = "Select username From users;";
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $user = $cmd->fetchAll();


    foreach($user as $value) {
        if($value[0] == $username){
            $ok = false;
            $username_taken = true;
        }
    }
}

if($ok) {
//hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);

//set up and execute the insert
    try{
    require_once("db.php");

    $sql = "Insert Into users (username, password) Values (:username, :password);";
    $cmd = $db->prepare($sql);

    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
    $cmd->execute();

//disconnect
    $db = null;
    }
    catch (Exception $e) {
        header('location:error.php');
    }
//show a message to the user
    echo"User Has Been Saved";
    header('location:login.php');
}else{
    header('location:register.php?invalid=true'. (($username_taken)? "&usernameTaken=true": ""));
}

?>
</body>
</html>