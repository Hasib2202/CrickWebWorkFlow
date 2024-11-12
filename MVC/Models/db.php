<?php
// Database connection details
$dbhost = "localhost";
$dbname = "crickweb";
$dbuser = "root";
$dbpass = "";

// Create a connection function
function getConnection() {
    global $dbhost, $dbname, $dbuser, $dbpass;
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    if (mysqli_connect_errno()) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    return $connection;
}
?>
