<?php

class Category {

	private $id;
	private $name;
    private $disabled;

	function __construct($id, $name, $disabled) {
		$this->id = $id;
		$this->name = $name;
        $this->disabled = $disabled;
	}

    public function getID() {
        return $this->id;
    }
 
    public function getName() {
        return $this->name;
    }
    
    public function getDisabled() {
        return $this->disabled;
    }
 
}

?>