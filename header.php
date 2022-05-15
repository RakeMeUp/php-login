<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <nav>
        <?php
        if (isset($_SESSION["userUID"])) {
            echo "<li><a href='profile.php'><button>Profile</button></a></li>";
            echo "<li><a href='index.php'><button>Home</button></a></li>";
            echo "<li><a href='includes/logout-inc.php'><button>Log Out</button></a></li>";
        } else {
            echo "<li><a href='signup.php'><button>Sign Up</button></a></li>";
            echo "<li><a href='index.php'><button>Home</button></a></li>";
            echo "<li><a href='login.php'><button>Login</button></a></li>";
        }
        ?>
    </nav>