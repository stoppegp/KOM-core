<?php

class Pledgestatetype {

	private $id;
	private $name;
	private $value;
    private $multipl;
    private $type;
    private $order;
    private $colour;
    private $colour2;

	function __construct($id, $name, $value, $multipl, $type, $order, $colour, $colour2) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
        $this->multipl = $multipl;
		$this->type = $type;
		$this->order = $order;
		$this->colour = $colour;
        $this->colour2 = $colour2;
	}

    
    /* Getter-Funktionen */
    
    public function getID() {
        return $this->id;
    }    
    
    public function getName() {
        return $this->name;
    }
    
    public function getValue() {
        return $this->value;
    }
    
    public function getMultipl() {
        return $this->multipl;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function getOrder() {
        return $this->order;
    }
    
    public function getColour() {
        return $this->colour;
    }
    
    public function getColour2() {
        return $this->colour;
    }
}

?>