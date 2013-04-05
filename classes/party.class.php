<?php

class Party {

	private $id;
	private $name;
	private $acronym;
    private $colour;
	private $programme_url;
	private $programme_offset;
	private $doValue;
    private $order;

	function __construct($id, $name, $acronym, $colour, $programme_url, $programme_offset, $doValue, $order) {
		$this->id = $id;
		$this->name = $name;
		$this->acronym = $acronym;
        $this->colour = $colour;
		$this->programme_url = $programme_url;
		$this->programme_offset = $programme_offset;
		$this->doValue = $doValue;
        $this->order = $order;
	}

    
    /* Getter-Funktionen */
    
    public function getID() {
        return $this->id;
    }    
    
    public function getName() {
        return $this->name;
    }
    
    public function getAcronym() {
        return $this->acronym;
    }
    
    public function getColour() {
        return $this->colour;
    }
    
    public function getProgrammeURL() {
        return $this->programme_url;
    }
    
    public function getProgrammeOffset() {
        return $this->programme_offset;
    }
    
    public function getDoValue() {
        return $this->doValue;
    }
}

?>