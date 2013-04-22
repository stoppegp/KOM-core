<?php
/*------------------------------ 
KOM-Core
Klasse "Pledge"

Verwaltet die Versprechen des KOM.

Autor: stoppe, Lizenz: dowhateveryouwant
------------------------------ */


class Pledge {

	private $id;
    private $issue_id;
	private $name;
	private $desc;
    private $type;
    private $party_id;
    private $default_pledgestatetype_id;
    private $quote;

    private $linkDatabase;
    private $linkIssue;
    private $linkParty;
    private $linkDefaultPledgestatetype;

	function __construct(&$linkIssue, $id, $issue_id, $name, $desc, $type, $quotetext, $quotesource, $quoteurl, $quotetype, $party_id, $quotepage, $default_pledgestatetype_id) {
        $this->linkIssue = &$linkIssue;
        $this->linkDatabase = $this->linkIssue->getDatabase();
    
		$this->id = $id;
        $this->issue_id = $issue_id;
		$this->name = $name;
		$this->desc = $desc;
        $this->type = $type;
        $this->party_id = $party_id;
        $this->default_pledgestatetype_id = $default_pledgestatetype_id;

        $this->quote = new Quote($quotetype, $quotetext, $quotesource, $quoteurl, $quotepage);
        
        $this->linkParty = $this->linkDatabase->getParty($party_id);
        $this->linkDefaultPledgestatetype = $this->linkDatabase->getPledgestatetype($default_pledgestatetype_id);
	}
    
    
    
    /* Getter-Funktionen */
    
    public function getID() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getDesc() {
        return $this->desc;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function getParty() {
        return $this->linkParty;
    }
    
    public function getQuote() {
        return $this->quote;
    }

    public function getCurrentPledgestatetype() {
        return $this->getPledgestatetypeAtDatum(time());
    }
    
    public function getPledgestatetypeAtDatum($datum) {
        if ($datum < $this->linkDatabase->getOption("start_datum")) {
            throw new Exception("Datum zu früh.");
        }
        $ret = $this->linkIssue->getStateAtDatum($datum, $this->id);
        if ($ret) {
            foreach ($ret->getPledgestates() as $key => $val) {
                if ($val->getPledgeID() == $this->id) {
                    return $val->getPledgestatetype();
                }
            }
        } else {
            return $this->linkDefaultPledgestatetype;
        }
    }
    
    public function getCurrentState() {
        return $this->getStateAtDatum(time());
    }
    
    public function getStateAtDatum($datum) {
        return $this->linkIssue->getStateAtDatum($datum, $this->id);
        
    }
    
    public function getDefaultPledgestatetype() {
        return $this->linkDefaultPledgestatetype;
    }
    
    
    public function getQuoteText() {
        return $this->quote->getText();
    }
    public function getQuoteSource() {
        if ($this->quote->getType() == "programme") {
            return $this->linkParty->getProgrammeName().", Seite ".$this->quote->getPage();
        } else {
            return $this->quote->getSource();
        }
    }
    public function getQuoteURL() {
        if ($this->quote->getType() == "programme") {
            return $this->linkParty->getProgrammeURL()."#page=".($this->linkParty->getProgrammeOffset()+$this->quote->getPage());
        } else {
            return $this->quote->getURL();
        }
    }
    
    public function getIssue() {
        return $this->linkIssue;
    }
}

?>