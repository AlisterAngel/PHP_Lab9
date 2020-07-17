<?php
$usernameTaken = $_GET["usernameTaken"];
$invalid = $_GET["invalid"];
?>
<?php
$title_of_page = "Register";
$register_required = "register";
require_once("header.php");
?>
<h1>User Registration</h1>
<form method="post" action="save-registration.php">
    <?php
    if ($usernameTaken){
        echo "<p style='color: crimson'>Sorry that username has been taken.</p>";
    }
    else if  ($invalid) {
        echo "<p style='color: crimson'>Please make sure Passwords match.</p>";
    }
    ?>
    <label for="username">Username</label>
    <div class="input">
        <input name="username" id="username" placeholder="Username" required/>
    </div>
    <label for="password">Password</label>
    <div class="input">
        <input name="password" id="password" placeholder="Password" required type="password"/>
    </div>
    <label for="confirm">Confirm Password</label>
    <div class="input">
        <input name="confirm" id="confirm" placeholder="Repeat Password" required type="password"/>
    </div>
    <button>Register</button>
</form>
<?php
require_once("footer.php")
?>