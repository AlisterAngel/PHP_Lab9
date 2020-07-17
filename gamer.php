<?php
$title_of_page = "Gamer Information";
$register_required = "true";
require_once("auth.php");
require_once("header.php");
?>
<?php
// check the url for a gamer_id parameter and store the value in a variable if we find one
if (!empty($_GET['gamer_id'])) {
    $gamer_id = $_GET['gamer_id'];

    // connect
    try{
    require("db.php");

    // write the sql query
    $sql = "SELECT * FROM gamer WHERE gamer_id = :gamer_id";

    // execute the query and store the results
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':gamer_id', $gamer_id, PDO::PARAM_INT);
    $cmd->execute();
    $gamer = $cmd->fetch();

    // populate the fields for the selected gamer from the query result
    $firstName = $gamer['firstName'];
    $lastName = $gamer['lastName'];
    $age = $gamer['age'];
    $game = $gamer['game'];
    $typeOfGamer = $gamer['typeOfGamer'];


    // disconnect
    $db = null;
    }
    catch (Exception $e) {
        header('location:error.php');
    }
}
?>
<h1>Gamer Information Collection <a href="view-gamers.php" title="View Other Gamers"><img src="images/GamerTag.png"></a></h1>
<form action="save-gamer.php" method="post">
    <label for="firstName" >First Name:</label>
    <div class="input">
        <input name="firstName" id="firstName" placeholder="First Name" required value="<?php echo $firstName; ?>"/><br/>
    </div>
    <label for="lastName" >Last Name:</label>
    <div class="input">
        <input name="lastName" id="lastName" placeholder="Last Name" required value="<?php echo $lastName; ?>"/><br/>
    </div>
    <label for="age" >Age:</label>
    <div class="input">
        <input name="age" id="age" type="number" min="5" max="100" placeholder="5-100" required value="<?php echo $age; ?>"/><br/>
    </div>
    <label for="game" >Game:</label>
    <div class="input">
        <input name="game" id="game" placeholder="Name of Game" required value="<?php echo $game; ?>"/><br/>
    </div>
    <label for="typeOfGamer" >Type Of Gamer:</label>
    <div class="input">
    <select name="typeOfGamer" id="typeOfGamer" required >
        <?php
        //connect to database
        try{
        require_once("db.php");

        //get all types from the gamer table
        $sql = "Select type From gamerType;";
        $cmd = $db->prepare($sql);
        $cmd->execute();
        $type = $cmd->fetchAll();

        //add each type to the dropdown
        foreach($type as $value){
                echo '<option' . (($value['type'] == $typeOfGamer)? ' selected' : '') . '>' . $value['type'] . '</option>';
        }

        $db = null;
        }
        catch (Exception $e) {
            header('location:error.php');
        }
        ?>
    </select>
    <input name="gamer_id" type="hidden" value="<?php echo $gamer_id; ?>" />
    <br />
    </div>
    <!--Save button-->
    <button id="save-btn">Save Gamer</button>
</form>
<?php
    require_once("footer.php")
?>