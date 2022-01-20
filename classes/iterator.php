<?php
class myIterator implements Iterator {
    private $array;  

    public function __construct($arr) {
        $this->array = $arr;
    }

    function rewind() : void{
        reset($this->array);
    }
    
    function current() {
        return current($this->array);
    }
    
    function key() {
        return key($this->array);
    }
    
    function next() : void {
        next($this->array);
    }
    
    function valid() : bool {
        return key($this->array) !== null;
    }
}

?>