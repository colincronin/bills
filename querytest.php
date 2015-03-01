<?php
# Require the Connection Credentials, Global Functions, and Table Creation
require 'con.php';
require 'functions.php';

# Open the Database Connection
try {
    $db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$dbusername, $dbpassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    # Grab the data (From a form that will be created in the future)
    $n = 'Test Company'.mt_rand(1,5);
    $t = NULL;
    $d = '2015-07-01';
    $a = mt_rand(0*100,100*100)/100;
    $p = FALSE;
    $newbill = new newbill($n,$t,$d,$a,$p);

    # Prepare and Execute SQL Statements
    $stmt = $db->prepare('INSERT INTO '.$tablename.' (name, type, date, amount, paid) VALUES (:name, :type, :date, :amount, :paid)');
    $stmt->execute((array)$newbill);
}
catch(PDOException $e) {
    echo '<b>Error: '.$e->getMessage(). '<br></b>';
}
$insertId = $db->lastInsertId();

# Display the Results
echo $newbill->describe()." Inserted!<br>";
echo "Last Insert Id: ";
echo $insertId;

# Close the Database Connection
$db = NULL;
?>
