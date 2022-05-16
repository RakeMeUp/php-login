<?php
include_once 'header.php'
?>

<?php
if (isset($_SESSION["userUID"])) {
    echo "<section><h2>You Are Successfully Logged In.</h2>";
    echo "<p>Your username is " . $_SESSION["userUID"] . "</p>";
    echo "</section>";
} else {
    echo "<section><h2>Log in please.</h2></section>";
}
?>

<?php
include_once 'footer.php'
?>