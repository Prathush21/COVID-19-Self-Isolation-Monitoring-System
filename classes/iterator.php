<?php
class myIterator implements Iterator {
    private $position = 0;
    private $array;  

    public function __construct($arr) {
        $this->position = 0;
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