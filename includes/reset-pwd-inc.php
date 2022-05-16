<?php
if (isset($_POST["reset-final-pwd-submit"])) {
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwd-repeat"];

    if (empty($pwd) || empty($pwdRepeat)) {
        header("Location: ../login.php?newpwd=empty");
        exit();
    } else if ($pwd != $pwdRepeat) {
        header("Location: ../login.php?newpwd=pwdnotsame");
        exit();
    }

    $currentDate = date("U");

    require 'dbh-inc.php';

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= $currentDate;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "error bruh";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $selector);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if(!$row = mysqli_fetch_assoc($result)){
            echo "error";
            exit();
        }else{
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if($tokenCheck === false){
                echo "error";
                exit();
            }else if($tokenCheck === true){
                $tokenEmail = $row['pwdResetEmail'];

                $sql = "SELECT * FROM users WHERE usersEmail=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "error bruh";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if(!$row = mysqli_fetch_assoc($result)){
                        echo "error";
                        exit();
                    }else{
                        $sql = "UPDATE users SET pwdUsers=? WHERE usersEmail=?;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "error bruh";
                            exit();
                        } else {
                            $newPwdHash = password_hash($pwd, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "error bruh";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                                mysqli_stmt_execute($stmt);
                            }
                            }
                }
            }
        }
    }
} else {
    header("Location: ../index.php");
}
