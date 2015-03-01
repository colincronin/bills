<?php
# Require the Connection Credentials
require 'con.php';
# Connect to MySQL
$pdo = new PDO("mysql:host=$host", $dbusername, $dbpassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

# Create the Database if it doesn't already exist
$dbname = "`".str_replace("`","``",$dbname)."`";
$pdo->query("CREATE DATABASE IF NOT EXISTS $dbname");
$pdo->query("use $dbname");
echo "Using Database: <b>$dbname</b><br>";

# Close the Database Connection
$pdo = NULL;
?>
