<?php
if (isset($_POST["reset-password-submit"])) {

    //prevent timing attack by 2 tokens
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "localhost/proj1/create-new-password.php?selector=$selector&validator=" . bin2hex($token);

    //3mins
    $expires = date("U") + 180;

    require 'dbh-inc.php';

    $userEmail = $_POST["email"];

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "error bruh";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "error bruh";
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);

    $to = $userEmail;

    $subject = "Reset passw";

    $message = '<p>bruh i aint writin out that much shit</p>';
    $message .= '<p>HERE PWD:</p>';
    $message .= '<a href="' . $url . '">' . $url . '</a>';

    $headers = "From: me <bencehetes@gmail.com>\r\n";
    $headers .= "Reply-To: bencehetes@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

    header("Location: ../reset-password.php?reset=success");
} else {
    header("Location: ../login.php");
    exit();
}
