<?php

$dbconnection = "80.82.114.110";
$dbuser = "morganleeuosweb";
$dbpass = "Rainbow6siege";
$dbname = "Db1";

if (!$con = mysqli_connect($dbconnection, $dbuser, $dbpass, $dbname)) {
    die("Failed to connect to database");
}
