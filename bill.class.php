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
}
?>
