<?php
# Require the Connection Credentials and Table Creation
require 'con.php';

# Construct the bill object
class bill {
    public $id;
    public $name;
    public $type;
    public $date;
    public $amount;
    public $paid;

    function describe() {
        if($this->paid==NULL or $this->paid==0) {
            $this->paid='NOT PAID';
        }else{
            $this->paid='PAID';
        }
        echo $this->id.' - '.$this->name.' ('.$this->type.') - '.date('F j, Y',strtotime($this->date)).' $'.$this->amount.' - '.$this->paid;
    }
}

# Open the Database Connection
try {
    $db = new PDO('mysql:host=localhost;dbname='.$dbname.';charset=utf8',$dbusername, $dbpassword);
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
