<?php
# Require the Connection Credentials
require 'con.php';

# Construct the bill addition class
class newbill {
    public $name;
    public $type;
    public $date;
    public $amount;
    public $paid;

    function __construct($n,$t,$d,$a,$p) {
        $this->name = $n;
        if($t==NULL) {
            $t = 'Uncategorized';
        }
        $this->type = $t;
        $this->date = $d;
        $this->amount = $a;
        if($p==NULL) {
            $p = FALSE;
        }
        $this->paid = $p;
    }

    function describe() {
        echo $this->name.' ('.$this->type.') - '.date('F j, Y',strtotime($this->date));
    }


    function addBill() {
        global $host;
        global $dbusername;
        global $dbpassword;
        global $dbname;
        global $tablename;

        # Open the Database Connection
        try {
            $db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$dbusername, $dbpassword);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            # Prepare and Execute SQL Statements
            $stmt = $db->prepare('INSERT INTO '.$tablename.' (name, type, date, amount, paid) VALUES (:name, :type, :date, :amount, :paid)');
            $stmt->execute((array)$this);
        }
        catch(PDOException $e) {
            echo '<b>Error: '.$e->getMessage(). '<br></b>';
        }
        $insertId = $db->lastInsertId();

        # Display the Results
        echo $this->describe()." Inserted!<br>";
        echo "Last Insert Id: ";
        echo $insertId;

        # Close the Database Connection
        $db = NULL;
    }
}
?>
