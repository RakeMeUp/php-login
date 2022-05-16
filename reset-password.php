<?php
include_once 'header.php'
?>

<section>
    <h2>Reset your password</h2>
    <form action="includes/reset-password-inc.php" method="post">
        <input type="text" name="email" placeholder="Enter your email...">
        <button type="submit" name="reset-password-submit">Recieve new password</button>
    </form>
    <?php
    if (isset($_GET["reset"])) {
        if ($_GET["reset"] == "success") {
            echo '<p>Email Sent!</p>';
        }
    }
    ?>
</section>

<?php
include_once 'footer.php'
?>