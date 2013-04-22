<?php

class State {

	private $id;
    private $issue_id;
	private $name;
	private $datum;
    private $quote;
    
    private $isLoad = false;
    
    private $pledgestates = array();
    private $pledgestatesByPledge = array();

    private $linkDatabase;
    private $linkIssue;
    private $linkParty;

	function __construct(&$linkIssue, $id, $issue_id, $name, $datum, $quotetext, $quotesource, $quoteurl) {
        $this->linkIssue = &$linkIssue;
        $this->linkDatabase = $this->linkIssue->getDatabase();
    
		$this->id = $id;
        $this->issue_id = $issue_id;
		$this->name = $name;
		$this->datum = strtotime($datum);

        $this->quote = new Quote(1, $quotetext, $quotesource, $quoteurl, null);
	}
    
    public function loadContent() {
        $this->loadPledgestates();
        $this->isLoad = true;
    }
    
    private function loadPledgestates() {
        $retar = $this->linkDatabase->getLinkDB()->Select("pledgestates", "*", "WHERE state_id = ".$this->id);
        if (is_array($retar)) {
            foreach ($retar as $key => $val) {
                if ($val->pledgestatetype_id != 0) {
                    $this->pledgestates[$val->id] = new Pledgestate($this, $val->id, $val->pledgestatetype_id, $val->pledge_id, $val->state_id);
                    $this->pledgestatesByPledge[$val->pledge_id] = &$this->pledgestates[$val->id];
                }
            }
        }
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
    
    public function getDatabase() {
        return $this->linkDatabase;
    }   

    public function getIssue() {
        return $this->linkIssue;
    }   
    
    public function getPledgestates() {
        return $this->pledgestates;
    }
   
    public function getPledgestateOfPledge($id) {
        return $this->pledgestatesByPledge[$id];
    }
   
    public function getQuoteText() {
        return $this->quote->getText();
    }
    public function getQuoteSource() {
        return $this->quote->getSource();
    }
    public function getQuoteURL() {
        return $this->quote->getURL();
    }
    
}

?>