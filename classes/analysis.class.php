<?php

class Analysis {

    private $linkDatabase;

    function __construct($database) {
        $this->linkDatabase = &$database;
    }
    
    public function getStates($order = "id", $orient = "ASC") {
        $statesArray = array();
        $datumArray = array();
        if (is_array($this->linkDatabase->getIssues())) {
            foreach ($this->linkDatabase->getIssues() as $key => $value) {
                $statesArray = array_merge($value->getStates(), $statesArray);
            }
        }
        
        if (is_array($statesArray)) {
            foreach ($statesArray as $key => $value) {
                $datumArray[] = $value->getDatum();
            }
            
            switch ($order) {
             case "datum":
                array_multisort($datumArray, $statesArray);
                if ($orient == "ASC") {
                    return $statesArray;
                } else {
                    return array_reverse($statesArray);
                }
                break;
             default:
                return $statesArray;
            }
        } else {
            return false;
        }
    }
    
    public function getCurrentNumberOfPledgestatetypes() {
        return $this->getNumberOfPledgestatetypesAtDatum(time());
    }
    
    public function getNumberOfPledgestatetypesAtDatum($datum) {
        if (is_array($this->linkDatabase->getIssues())) {
            foreach ($this->linkDatabase->getIssues() as $key => $value) {
                if (is_array($value->getPledges())) {
                    foreach ($value->getPledges() as $key => $value) {
                        $pst_id = $value->getPledgestatetypeAtDatum($datum)->getID();
                        if (isset($counter_array[$pst_id])) {
                            $counter_array[$pst_id]++;
                        } else {
                            $counter_array[$pst_id] = 1;
                        }
                    }
                }
            }
        }
        if (is_array($counter_array)) {
            return $counter_array;
        } else {
            return false;
        }
    }
    
}