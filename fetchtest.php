<?php
# Require the Connection Credentials, Global Functions, and Table Creation
require 'con.php';
require 'functions.php';

# Open the Database Connection
try {
    $db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$dbusername, $dbpassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    # Fetch the data into the bill class
    $stmt = $db->query('SELECT id, name, type, date, amount, paid FROM '.$tablename);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'bill');
    while($obj = $stmt->fetch()) {
        echo $obj->describe().'<br>';
    }
}
catch(PDOException $e) {
    echo '<b>Error: '.$e->getMessage(). '<br></b>';
}

# Close the Database Connection
$db = NULL;
?>
