<?php
#Note, please reconfigure table bills after testing
$tablename="bills";
# Require the Connection Credentials
require 'con.php';
# Open the Database Connection
try {
    $db = new PDO('mysql:host=localhost;dbname='.$dbname.';charset=utf8',$dbusername, $dbpassword);
}
catch(PDOException $e) {
    echo $e->getMessage();
}
# Prepare and Execute SQL Statements
$stmt = 'CREATE TABLE IF NOT EXISTS '.$tablename.'
    (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    handle VARCHAR(20),
    activity VARCHAR(40))';
try {
    $db->exec($stmt);
    echo "Table <b>".$tablename."</b> created<br>";
}
catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}
$insertId = $db->lastInsertId();

# Display the Results
echo "Last Insert Id: ";
echo $insertId;

# Close the Database Connection
$db = NULL;

?>
