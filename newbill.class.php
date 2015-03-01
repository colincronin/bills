<?php
#Construct the bill addition subclass
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
}
?>
