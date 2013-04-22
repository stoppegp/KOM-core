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
    
    public function getChartseriesPieGroup($datum = false, $options = null) {
        
        if (!$datum) $datum = time();
        
        $nr = $this->getNumberOfPledgestatetypesAtDatum($datum);
        $group_nr = array();
        foreach ($this->linkDatabase->getPledgestatetypegroups() as $value0) {
			$group_nr[$value0->getID()] = 0;
            foreach ($this->linkDatabase->getPledgestatetypegroup($value0->getID())->getPledgestatetypes() as $value) {
                $group_nr[$value0->getID()] += $nr[$value->getID()];
            }
        }
    
        $chart1data = array();
        foreach ($this->linkDatabase->getPledgestatetypegroups() as $value0) {
            unset($tempar);
            $tempar['name'] = $value0->getName();
            $tempar['color'] = $value0->getColour();
            $tempar['y'] = $group_nr[$value0->getID()];
            if (isset($options[$value0->getID()]) && is_array($options[$value0->getID()])) {
                foreach ($options[$value0->getID()] as $key => $val) {
                    $tempar[$key] = $val;
                }
            }
            $chart1data[$value0->getOrder()] = $tempar;
        }
        ksort($chart1data);
        return array(array("type" => "pie", "data" => array_values($chart1data)));
            
    }
    
    public function getChartseriesPie($datum = false, $options = null) {
        
        if (!$datum) $datum = time();
        
        $nr = $this->getNumberOfPledgestatetypesAtDatum($datum);
        
        $chart1data = array();
        foreach ($this->linkDatabase->getPledgestatetypes() as $value0) {
            unset($tempar);
            if ( $tempar['y'] = $nr[$value0->getID()] * $value0->getMultipl() == 0) continue;
            $tempar['name'] = $value0->getName();
            $tempar['color'] = $value0->getColour();
            $tempar['y'] = $nr[$value0->getID()] * $value0->getMultipl();
            if (is_array($options[$value0->getID()])) {
                foreach ($options[$value0->getID()] as $key => $val) {
                    $tempar[$key] = $val;
                }
            }
            $chart1data[$value0->getOrder()] = $tempar;
            //echo $value0->getOrder();
        }
        ksort($chart1data);
        return array(array("type" => "pie", "data" => array_values($chart1data)));
            
    }
    
    public function getChartseriesTrendGroup($startdatum = false, $enddatum = false, $interval = 30, $options = null) {
    
        if (!$startdatum) $startdatum = $this->linkDatabase->getOption("start_datum");
        if (!$enddatum || ($enddatum > time())) $enddatum = time();
        if (!is_numeric($interval)) $interval = 30;
        
        $c2d = array();

        for ($a = $startdatum; $a < $enddatum; $a += $interval*86400) {
            unset($temp0);
            $temp0 = $this->getNumberOfPledgestatetypesAtDatum($a);
            if (is_array($temp0)) {
                foreach ($this->linkDatabase->getPledgestatetypegroups() as $val0) {
					$c2d[$val0->getID()][$a] = 0;
                    foreach ($this->linkDatabase->getPledgestatetypegroup($val0->getID())->getPledgestatetypes() as $value) {
                        if (!isset($temp0[$value->getID()])) $temp0[$value->getID()] = "0";
                        $c2d[$val0->getID()][$a] += $temp0[$value->getID()]*$value->getMultipl();
                    }
                }
            }
        }
        
        
        
        foreach ($c2d as $key => $val) {
            $sno = $this->linkDatabase->getPledgestatetypegroup($key)->getOrder();
            $temp00 = null;
            $temp00 = array(
                'name' => $this->linkDatabase->getPledgestatetypegroup($key)->getName(),
                'color' => $this->linkDatabase->getPledgestatetypegroup($key)->getColour(),
            );
            if (is_array($options[$key])) {
                foreach ($options[$key] as $key0 => $val0) {
                    $temp00[$key0] = $val0;
                }
            }
            
            if (!array_sum($val) == 0) {
                foreach ($val as $key2 => $val2) {
                    if (!isset($valbef) || $valbef != $val2 || true) {
                        //$temp00['data'][] = "[".$key2."000".",".$val2."]";  
                        $ar['x'] = $key2."000";
                        $ar['y'] = $val2;
                        
                        $temp00['data'][] = $ar;
                    }
                    $valbef = $val2;
                }
                $temp01 = $this->getNumberOfPledgestatetypesAtDatum($enddatum);
				$temp010 = array();
                foreach ($this->linkDatabase->getPledgestatetypegroup($key)->getPledgestatetypes() as $value) {
                    if (!isset($temp01[$value->getID()])) $temp01[$value->getID()] = "0";
					if (!isset($temp010[$key])) $temp010[$key] = 0;
                    $temp010[$key] += $temp01[$value->getID()];
                }
                
                $ar['x'] = $enddatum."000";
                $ar['y'] = $temp010[$key];
                $temp00['data'][] = $ar;
                
                unset($valbef);
                $arsno[$sno] = $temp00;
            }
        }
        krsort($arsno);
        $retar = array();
        foreach ($arsno as $val) {
            $retar[] = $val;
        }
        return $retar;
    
    }
    
    public function getChartseriesTrend($startdatum = false, $enddatum = false, $interval = 30, $options = false) {
    
        if (!$startdatum) $startdatum = $this->linkDatabase->getOption("start_datum");
        if (!$enddatum || ($enddatum > time())) $enddatum = time();
        if (!is_numeric($interval)) $interval = 30;
        
        $c2d = array();

        for ($a = $startdatum; $a < $enddatum; $a += $interval*86400) {
            unset($temp0);
            $temp0 = $this->getNumberOfPledgestatetypesAtDatum($a);
            if (is_array($temp0)) {
                foreach ($this->linkDatabase->getPledgestatetypes() as $value) {
                    if (!isset($temp0[$value->getID()])) $temp0[$value->getID()] = "0";
                    $c2d[$value->getID()][$a] = $temp0[$value->getID()]*$value->getMultipl();
                }
            }
        }
        
        
        
        foreach ($c2d as $key => $val) {
            $sno = $this->linkDatabase->getPledgestatetype($key)->getOrder();
            $groups = $this->linkDatabase->getGroupsOfPledgestatetype($key);
            $temp00 = null;
            $temp00 = array(
                'name' => $this->linkDatabase->getPledgestatetype($key)->getName(),
                'color' => $this->linkDatabase->getPledgestatetype($key)->getColour(),
            );
            if (is_array($options[$key])) {
                foreach ($options[$key] as $key0 => $val0) {
                    $temp00[$key0] = $val0;
                }
            }
            if (!array_sum($val) == 0) {
                foreach ($val as $key2 => $val2) {
                    if (!isset($valbef) || $valbef != $val2 || true) {
                        //$temp00['data'][] = "[".$key2."000".",".$val2."]";  
                        $ar['x'] = $key2."000";
                        $ar['y'] = $val2;
                        
                        $temp00['data'][] = $ar;
                    }
                    $valbef = $val2;
                }
                $temp01 = $this->getNumberOfPledgestatetypesAtDatum($enddatum);
                if (!isset($temp01[$key])) $temp01[$key] = "0";
                
                $ar['x'] = $enddatum."000";
                $ar['y'] = $temp01[$key];
                
                $temp00['data'][] = $ar;
                unset($valbef);
                $arsno[$sno] = $temp00;
            }
        }
        krsort($arsno);
        $retar = array();
        foreach ($arsno as $val) {
            $retar[] = $val;
        }
        return $retar;
    
    }
 
}