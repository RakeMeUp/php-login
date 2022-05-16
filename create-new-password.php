<?php
include_once 'header.php'
?>

<section>
    <h2>Reset your password</h2>
    <?php
    $selector = $_GET["selector"];
    $validator = $_GET["validator"];

    if (empty($selector) || empty($validator)) {
        echo "major fuckup";
    } else {
        if (ctype_xdigit($selector) !== false && ctype_xdigit($validator)) {
    ?>

            <form action="includes/reset-password-inc.php" method="post">
                <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                <input type="hidden" name="validator" value="<?php echo $selector; ?>">
                <input type="password" name="pwd" placeholder="Enter Password...">
                <input type="password" name="pwd-repeat" placeholder="Confirm Password...">
                <button type="submit" name="reset-final-pwd-submit">Reset Password</button>
            </form>

    <?php
        }
    }
    ?>
</section>

<?php
include_once 'footer.php'
?>