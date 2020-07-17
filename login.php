<?php
    $invalid = $_GET["invalid"];
?>
<?php
$title_of_page = "Login";
$register_required = "login";
require_once("header.php");
?>
<h1>Login</h1>
<form id="loginForm" method="post" action="validate.php">
    <?php
    if  ($invalid) {
        echo "<p style='color: crimson'>Sorry not found. Please make sure Username and Password are correct.</p>";
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
    <button id="loginBtn">Login</button>
</form>
<?php
require_once("footer.php")
?>