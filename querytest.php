<?php
# Require the Connection Credentials, Global Functions, and Table Creation
require 'con.php';
require 'functions.php';

# Grab the data (From a form that will be created in the future)
$n = 'Test Company'.mt_rand(1,5);
$t = NULL;
$d = '2015-07-01';
$a = mt_rand(0*100,100*100)/100;
$p = FALSE;
$newbill = new newbill($n,$t,$d,$a,$p);

# Add the new bill to the database
$newbill->addBill();

?>
