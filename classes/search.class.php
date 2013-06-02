<?php

class Search {

    private $linkDatabase;
    private $searchstring;
    private $searchtype;
    private $must;
    private $not;
    private $can;

    function __construct($database, $searchstring) {
        $this->linkDatabase = &$database;
        $this->searchstring = &$searchstring;
        
        $tempar = explode(" ", $searchstring);
        $mustar = array();
        $notar = array();
        $canar = array();
        foreach ($tempar as $val) {
            if (strpos("0".$val, "+") == 1) {
                if (trim(substr($val, 1)) != "") $mustar[] = strtolower(substr($val, 1));
            } elseif (strpos("0".$val, "-") == 1) {
                if (trim(substr($val, 1)) != "") $notar[] = strtolower(substr($val, 1));
            } else {
                if (trim($val) != "") $canar[] = strtolower($val);
            }
        }
        $this->must = $mustar;
        $this->not = $notar;
        $this->can = $canar;
    }
    
    function doSearchIssues() {
        $found = array();
        $foundcounter = 0;
        $foundnumber = array();
        if (is_array($this->linkDatabase->getIssues()) && (count($this->linkDatabase->getIssues()) > 0)) {
            foreach ($this->linkDatabase->getIssues() as $val) {
                $textstring = $val->getName()." ".$val->getDesc();
                $ret = $this->doSearch($textstring);
                if ($ret != false) {
                    $found[++$foundcounter] = $val;
                    $foundnumber[$foundcounter] = $ret;
                }
            }
            if (count($found) > 0) {
                array_multisort($foundnumber, SORT_DESC, $found);
                return $found;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    function doSearchPledges() {
        $found = array();
        $foundcounter = 0;
        $foundnumber = array();
        if (is_array($this->linkDatabase->getIssues()) && (count($this->linkDatabase->getIssues()) > 0)) {
            foreach ($this->linkDatabase->getIssues() as $val0) {
                if (is_array($val0->getPledges())) {
                    foreach ($val0->getPledges() as $val) {
                        $textstring = $val->getName()." ".$val->getDesc()." ".$val->getQuoteText();
                        $ret = $this->doSearch($textstring);
                        if ($ret != false) {
                            $found[++$foundcounter] = $val;
                            $foundnumber[$foundcounter] = $ret;
                        }
                    }
                }
            }
            if (count($found) > 0) {
                array_multisort($foundnumber, SORT_DESC, $found);
                return $found;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    function doSearchStates() {
        $found = array();
        $foundcounter = 0;
        $foundnumber = array();
        if (is_array($this->linkDatabase->getIssues()) && (count($this->linkDatabase->getIssues()) > 0)) {
            foreach ($this->linkDatabase->getIssues() as $val0) {
                if (is_array($val0->getStates())) {
                    foreach ($val0->getStates() as $val) {
                        $textstring = $val->getName()." ".$val->getQuoteText();
                        $ret = $this->doSearch($textstring);
                        if ($ret != false) {
                            $found[++$foundcounter] = $val;
                            $foundnumber[$foundcounter] = $ret;
                        }
                    }
                }
            }
            if (count($found) > 0) {
                array_multisort($foundnumber, SORT_DESC, $found);
                return $found;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    function doSearch($textstring) {
            $textstring = strtolower($textstring);
            if (is_array($this->not) && (count($this->not) > 0)) {
                $foundwrong = false;
                foreach ($this->not as $val2) {
                    if (strpos("$".$textstring, $val2) > 0) {
                        $foundwrong = true;
                        break;
                    }
                }
                if ($foundwrong == true) {
                    return false;
                }
            }
            if (is_array($this->must) && (count($this->must) > 0)) {
                $foundwrong = false;
                foreach ($this->must as $val2) {
                    if (strpos("$".$textstring, $val2) == 0) {
                        $foundwrong = true;
                        break;
                    } else {
                        if ($foundnumber) {
                            $foundnumber += substr_count($textstring, $val2);
                        } else {
                            $foundnumber = substr_count($textstring, $val2);
                        }
                    }
                }
                if ($foundwrong == true) {
                    return false;
                }
            }
            if (is_array($this->can) && (count($this->can) > 0)) {
                foreach ($this->can as $val2) {
                    if (substr_count($textstring, $val2) > 0) {
                        if ($foundnumber) {
                            $foundnumber += substr_count($textstring, $val2);
                        } else {
                            $foundnumber = substr_count($textstring, $val2);
                        }
                    }
                }
            }
            if ($foundnumber > 0) {
                return $foundnumber;
            } else {
                return false;
            }
    }
    
    
}

?>