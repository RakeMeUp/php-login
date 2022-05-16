<?php
include_once 'header.php'
?>

<section>
    <h2>Login</h2>
    <form action="includes/login-inc.php" method="post">
        <input type="text" name="uid" placeholder="Username / Email...">
        <input type="password" name="pwd" placeholder="Password...">
        <button type="submit" name="submit">Login</button>
    </form>
    <div class="link-container">
        <a href="reset-password.php">Forgot your password?</a>
    </div>
    <?php
    if (isset($_GET["error"])) {
        switch ($_GET["error"]) {
            case "emptyinput":
                echo "<p>Fill all fields</p>";
                break;
            case "wronglogin":
                echo "<p>Bad Login try</p>";
                break;
        }
    }
    ?>
</section>

<?php
include_once 'footer.php'
?>