<?php
# Construct the bill object
class bill {
    public $id;
    public $name;
    public $type;
    public $date;
    public $amount;
    public $paid;

    public function describe() {
        if($this->paid==NULL or $this->paid==0) {
            $this->paid='NOT PAID';
        }else{
            $this->paid='PAID';
        }
        echo $this->id.' - '.$this->name.' ('.$this->type.') - '.date('F j, Y',strtotime($this->date)).' $'.$this->amount.' - '.$this->paid;
    }

    function fetchAllBills() {
        global $host;
        global $dbusername;
        global $dbpassword;
        global $dbname;
        global $tablename;

        # Open the Database Connection
        try {
            $db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$dbusername, $dbpassword);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            # Fetch the data into the bill class
            $stmt = $db->query('SELECT id, name, type, date, amount, paid FROM '.$tablename);
            $fetchTotal = $stmt->rowCount();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'bill');
            $i = 0;
            while($i<$fetchTotal-1) {
                $obj = $stmt->fetch();
                echo $obj->describe().'<br>';
                $i++;
            }
            $obj = $stmt->fetch();
            echo $obj->describe();
            echo '<br><br>';
            print_r($fetchTotal);
        }
        catch(PDOException $e) {
            echo '<b>Error: '.$e->getMessage(). '<br></b>';
        }

        # Close the Database Connection
        $db = NULL;
    }

    function fetchId($n) {
        global $host;
        global $dbusername;
        global $dbpassword;
        global $dbname;
        global $tablename;

        # Open the Database Connection
        try {
            $db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$dbusername, $dbpassword);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            # Fetch the requested id
            $stmt = $db->prepare('SELECT id FROM '.$tablename.' WHERE name='.$db->quote($n));
            $stmt->execute();
            $fetchId = $stmt->fetchAll();
            $idArray = array();
            foreach($fetchId as $key=>$value) {
                $idArray[$key] = $value['id'];
            }
            $idCount = count($idArray);
            $idArray['idCount'] = $idCount;
            return $idArray;
        }
        catch(PDOException $e) {
            echo '<b>Error: '.$e->getMessage(). '<br></b>';
        }

        # Close the Database Connection
        $db = NULL;
    }
}
?>
