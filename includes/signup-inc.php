<?php

if (isset($_POST["submit"])) {
    //echo "It works";

    $name = $_POST["name"];
    $email = $_POST["email"];
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once 'dbh-inc.php';
    require_once 'functions-inc.php';

    // ERROR CHECKING
    if (emptyInputSignup($name, $email, $uid, $pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    };
    if (invalidUID($uid)) {
        header("location: ../signup.php?error=invaliduid");
        exit();
    };
    if (invalidEmail($email)) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    };
    if (pwdMatch($pwd, $pwdRepeat)) {
        header("location: ../signup.php?error=pwdsnotmatching");
        exit();
    };
    if (uIDExists($conn, $uid, $email)) {
        header("location: ../signup.php?error=uidtaken");
        exit();
    };

    createUser($conn, $name, $email, $uid, $pwd);
} else {
    header("location: ../signup.php");
    exit();
}
