<?php


class Pledgestate {

	private $id;
    private $pledgestatetype_id;
	private $pledge_id;
	private $state_id;

    private $linkDatabase;
    private $linkIssue;
    private $linkState;
    private $linkPledge;
    private $linkPledgestatetype;

	function __construct(&$linkState, $id, $pledgestatetype_id, $pledge_id, $state_id) {
        $this->linkState = &$linkState;
        $this->linkIssue = $this->linkState->getIssue();
        $this->linkDatabase = $this->linkIssue->getDatabase();
        $this->linkPledgestatetype = $this->linkDatabase->getPledgestatetype($pledgestatetype_id);
        $this->linkPledge = $this->linkIssue->getPledge($pledge_id);
        
		$this->id = $id;
        $this->pledgestatetype_id = $pledgestatetype_id;
		$this->pledge_id = $pledge_id;
		$this->state_id = $state_id;

	}
    
    
    
    
    
    /* Getter-Funktionen */
    
    public function getID() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }
    
    public function getDatum() {
        return $this->datum;
    }
    
    public function getQuote() {
        return $this->quote;
    }

    public function getPledgeID() {
        return $this->pledge_id;
    }

    public function getPledgestatetype() {
        return $this->linkPledgestatetype;
    }
    
    public function getPledge() {
        return $this->linkPledge;
    }
}

?>