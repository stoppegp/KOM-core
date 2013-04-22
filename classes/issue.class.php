<?php
/*------------------------------ 
KOM-Core
Klasse "Issue"

Verwaltet die Themen des KOM.

Autor: stoppe, Lizenz: dowhateveryouwant
------------------------------ */

class Issue {

	private $id;
	private $name;
	private $desc;
    private $category_ids;
    
    private $pledges = array();
    private $pledgesByParty = array();
    private $states = array();
    private $statesByDatum = array();

    private $linkDatabase;
    private $filters;
    private $isLoad = false;

	function __construct(&$linkDatabase, $id, $name, $desc, $category_ids) {
        $this->linkDatabase = &$linkDatabase;
    
		$this->id = $id;
		$this->name = $name;
		$this->desc = $desc;
        $this->category_ids = unserialize($category_ids);
	}
    
    public function setFilter($key, $val) {
        if (isset($this->isLoaded) && $this->isLoaded) {
            throw new Exception('Modifying filters not possible when content is load');
        } else {
            switch ($key) {
             case "parties":
                if (is_array($val)) {
                    $this->filters[$key] = $val;
                } else {
                    $this->filters[$key] = array($val);
                }
                break;
                case "pledgestatetypeids":
                    if (is_array($val)) {
                        $this->filters[$key] = $val;
                    } else {
                        $this->filters[$key] = array($val);
                    }
                    break;
            }
        }
    }
    
    public function loadContent() {
        $this->loadStates();
        $this->loadPledgestates();
        $this->loadPledges();
        $this->loadPledgestates();
        $this->isLoad = true;
    }
    
    private function loadPledges() {
        $retar = $this->linkDatabase->getLinkDB()->Select("pledges", "*", "WHERE issue_id = ".$this->id);
        if (is_array($retar)) {
            foreach ($retar as $key => $val) {
                if ((!(isset($this->filters['parties']) && is_array($this->filters['parties']))) || in_array($val->party_id, $this->filters['parties'])) {
                    $this->pledges[$val->id] = new Pledge($this, $val->id, $this->id, $val->name, $val->desc, $val->type, $val->quotetext, $val->quotesource, $val->quoteurl, $val->quotetype, $val->party_id, $val->quotepage, $val->default_pledgestatetype_id);
                    
                    if (isset($this->filters['pledgestatetypeids']) && (is_array($this->filters['pledgestatetypeids'])) && !in_array($this->pledges[$val->id]->getCurrentPledgestatetype()->getID(), $this->filters['pledgestatetypeids']) || !$this->pledges[$val->id]->getParty()->getDoValue()) {
                        unset($this->pledges[$val->id]);
                    } else {
                        $this->pledgesByParty[$val->party_id][] = $this->pledges[$val->id];
                    }
                }
                
            }
        }
    }
    
    private function loadStates() {
        $retar = $this->linkDatabase->getLinkDB()->Select("states", "*", "WHERE issue_id = ".$this->id." ORDER BY datum ASC");
        if (is_array($retar)) {
            foreach ($retar as $key => $val) {
                    $this->states[$val->id] = new State($this, $val->id, $this->id, $val->name, $val->datum, $val->quotetext, $val->quotesource, $val->quoteurl);
                    $this->statesByDatum[] = &$this->states[$val->id];
                    //$this->states[$val->id]->loadContent();
            }
        }
    }
    
    private function loadPledgestates() {
        $ar = $this->states;
        if (is_array($ar)) {
            foreach ($ar as $key => $val) {
                    $this->states[$key]->loadContent();
            }
        }
    }
    
    /* Getter-Funktionen */
    
    public function getCategories() {
        if (is_array($this->category_ids)) {
            foreach ($this->category_ids as $val) {
                $retar[$val] = $this->linkDatabase->getCategory($val);
            }
        }
        return $retar;
    }
    
    public function getDatabase() {
        return $this->linkDatabase;
    }

    public function getPledges() {
		if (isset($this->pledges)) {
			return $this->pledges;
		} else {
			return false;
		}
    }
    
    public function getPledge($id) {
        if (isset($this->pledges[$id])) {
			return $this->pledges[$id];
		} else {
			return false;
		}
    }
    
    public function getPledgesOfParty($party_id) {
        if (isset($this->pledgesByParty[$party_id])) {
			return $this->pledgesByParty[$party_id];
		} else {
			return false;
		}
    }
    
    public function getStates($order = "id", $orient = "ASC") {
        switch ($order) {
         case "datum":
            if ($orient == "ASC") {
                return $this->statesByDatum;
            } else {
                return array_reverse($this->statesByDatum);
            }
            break;
         default:
            return $this->states;
        }
        
    }
    
    public function getState($id) {
        return $this->states[$id];
    }
    
    public function getCurrentState() {
        return $this->getStateAtDatum(time());
    }
    
    public function getStateAtDatum($datum, $pledge = false) {
        foreach (array_reverse($this->statesByDatum) as $key => $val) {
            if ($val->getDatum() <= $datum) {
                if ($pledge) {
                    if (is_array($val->getPledgestates())) {
                        foreach ($val->getPledgestates() as $key2 => $val2) {
                            if ($val2->getPledgeID() == $pledge) {
                                return $this->states[$val->getID()];
                            }
                        }
                    }
                } else {
                    return $this->states[$val->getID()];
                }
            }
        }
        return false;
    }
    
    public function getID() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getDesc() {
        return $this->desc;
    }
    
}

?>