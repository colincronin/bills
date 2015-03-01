<?php
# Require the Connection Credentials, Global Functions, and Table Creation
require 'con.php';
require 'functions.php';

# Grab a list of the bills in the database
$bill = new bill();
$bill->fetchAllBills();
?>
