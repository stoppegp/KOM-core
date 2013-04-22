<?php

class Pledgestatetypegroup {

	private $id;
	private $name;
	private $pledgestatetype_ids = array();
    private $colour;
    private $linkDatabase;
    private $oder;

	function __construct($database, $id, $pledgestatetype_ids, $name, $colour, $order) {
		$this->id = $id;
        $this->linkDatabase = &$database;
		$this->name = $name;
		$this->pledgestatetype_ids = unserialize($pledgestatetype_ids);
		$this->colour = $colour;
        $this->order = $order;
        
	}

    
    /* Getter-Funktionen */
    
    public function getID() {
        return $this->id;
    }    
    
    public function getName() {
        return $this->name;
    }
    
    public function getColour() {
        return $this->colour;
    }
    public function getOrder() {
        return $this->order;
    }
    public function getPledgestatetypeIDs() {
        return $this->pledgestatetype_ids;
    }
    public function getPledgestatetypes() {
        if (is_array($this->pledgestatetype_ids)) {
            foreach ($this->pledgestatetype_ids as $val) {
                $retar[$val] = $this->linkDatabase->getPledgestatetype($val);
            }
        }
        return $retar;
    }
}

?>