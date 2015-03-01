<?php
# Require the Connection Credentials
require 'con.php';

# Open the Database Connection
try {
    $db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$dbusername, $dbpassword);
}
catch(PDOException $e) {
    echo $e->getMessage();
}

# Prepare and Execute SQL Statements
$stmt = 'CREATE TABLE IF NOT EXISTS '.$tablename.'('.implode(',',$tablefields).')';
try {
    $db->exec($stmt);
    echo "Table <b>".$tablename."</b> created<br>";
}
catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}
$numrows = $db->query('SELECT count(*) from '.$tablename)->fetchColumn();

# Display the Results
echo "Rows in ".$tablename.": ";
echo $numrows;
echo "<br>";

# Close the Database Connection
$db = NULL;
?>
