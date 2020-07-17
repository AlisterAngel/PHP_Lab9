<?php
$title_of_page = "Gamer Table";
session_start();
if (!empty($_SESSION['user_id'])) {
    $register_required = "true";
}else{
    $register_required = "view";
}
require_once("header.php");
?>
    <h1>Welcome To The Gamer Table <a href="gamer.php" title="Create A New Gamer"><img src="images/GamerTag.png"></a></h1>
<?php
try {
    //connect to database
    require("db.php");

    //get all information from the books table
    $sql = "Select * From gamer;";
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $gamer = $cmd->fetchAll();

    //Table
    echo '<table><thead><th>First Name</th><th>Last Name</th><th>Age</th><th>Type Of Gamer</th><th>Game</th>';

    session_start();
    if (!empty($_SESSION['user_id'])) {
        echo '<th>Edit</th><th>Delete</th>';
    }

    echo '</thead><tbody>';

    //add each row to the table
    foreach ($gamer as $value) {
        echo '<tr><td>' . $value['firstName'] . '</td>
            <td>' . $value['lastName'] . '</td>
            <td>' . $value['age'] . '</td>
            <td>' . $value['typeOfGamer'] . '</td>
            <td>' . $value['game'] . '</td>';

        session_start();
        if (!empty($_SESSION['user_id'])) {
            echo '<td><a href="gamer.php?gamer_id=' . $value['gamer_id'] . '" title="Edit">✍</a>
                <td><a href="delete-gamer.php?gamer_id=' . $value['gamer_id'] . '" title="Remove From List" onclick="return confirm(\'Are you sure you want to delete this gamer?\');">💣</a></td></tr>';
        }
    }

    echo '</tbody></table>';


    session_start();
    if (!empty($_SESSION['user_id'])) {


        echo "<img src='images/Loading.gif'/>";

        $sql = "Select * from gamerType;";
        $cmd = $db->prepare($sql);
        $cmd->execute();
        $gamerType = $cmd->fetchAll();

        //Table
        echo '<table><thead><th>Type</th><th>Description</th></thead><tbody>';

        //add each row to the table
        $CS = 0;
        foreach ($gamerType as $value) {
            echo '<tr style=' . (($CS % 2 == 0) ? '"color: #b514aa"' : '"color: #0ccef0"') . '><td>' . $value['type'] . '</td>
            <td>' . $value['description'] . '</td></tr>';
            $CS += 1;
        }

        echo '</tbody></table>';

        $db = null;
    }
}
catch (Exception $e) {
    header('location:error.php');
}

?>

<?php
require_once("footer.php");
?>