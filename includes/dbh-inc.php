<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "authDB";

//mysqli is for procedural php
//mysql redundant, mysqli is more secure
$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed :( => " . mysqli_connect_error());
}
