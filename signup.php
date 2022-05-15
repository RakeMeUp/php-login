<?php
include_once 'header.php'
?>

<section>
    <h2>Sign Up</h2>
    <form action="includes/signup-inc.php" method="post">
        <input type="text" name="name" placeholder="Name...">
        <input type="email" name="email" placeholder="Email...">
        <input type="text" name="uid" placeholder="Username...">
        <input type="password" name="pwd" placeholder="Password...">
        <input type="password" name="pwdrepeat" placeholder="Confirm Password...">
        <button type="submit" name="submit">Sign Up</button>
    </form>

    <?php
    if (isset($_GET["error"])) {
        switch ($_GET["error"]) {
            case "emptyinput":
                echo "<p>Fill all fields</p>";
                break;
            case "indvaliduid":
                echo "<p>Bad username</p>";
                break;
            case "indvalidemail":
                echo "<p>Bad email</p>";
                break;
            case "pwdsnotmatching":
                echo "<p>U messed up the pwds bruh</p>";
                break;
            case "uidtaken":
                echo "<p>Username already exists</p>";
                break;
            case "stmtfailed":
                echo "<p>Major mess up!!!!</p>";
                break;
            case "none":
                echo "<p>GOOD JOB</p>";
                break;
        }
    }
    ?>
</section>

<?php
include_once 'footer.php'
?>