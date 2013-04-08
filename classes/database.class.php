<?php

class Database {

    private $linkDB;    // Link zur MySQL-Datenbank-Instanz
    private $isLoad = false;  
    private $options = array();
    private $parties = array();
    private $partiesByOrder = array();
    private $categories = array();
    private $categoriesByName = array();
    private $issues = array();
    private $issuesByName = array();
    private $issuesByCategorie = array();
    private $pledgestatetypes = array();
    private $pledgestatetypegroups = array();
    private $filters;
    
    function __construct(&$linkDB) {
        $this->linkDB = &$linkDB;
        $this->loadOptions();
        $this->loadCategories();
        $this->loadParties();
        $this->loadPledgestatetypes();
        $this->loadPledgestatetypegroups();
    }
    
    
    public function setFilter($key, $val) {
        if ($this->isLoaded) {
            throw new Exception('Modifying filters not possible when content is load');
        } else {
            switch ($key) {
             case "categories":
                if (is_array($val)) {
                    $this->filters[$key] = $val;
                } else {
                    $this->filters[$key] = array($val);
                }
                break;
             case "parties":
                if (is_array($val)) {
                    $this->filters[$key] = $val;
                } else {
                    $this->filters[$key] = array($val);
                }
                break;
             case "issues":
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
            case "pledgestatetypegroup":
                if ($this->pledgestatetypegroups[$val]) {
                    if (is_array($this->pledgestatetypegroups[$val]->getPledgestatetypes())) {
                        foreach ($this->pledgestatetypegroups[$val]->getPledgestatetypes() as $value) {
                            $t0[] = $value->getID();
                        }
                        $this->setFilter("pledgestatetypeids", $t0);
                    }
                }
                break;
            }
        }
    }
    
    public function reloadBasics() {
        unset($this->options);
        unset($this->categories);
        unset($this->categoriesByName);
        unset($this->parties);
        unset($this->partiesByOrder);
        unset($this->pledgstatetypes);
        unset($this->pledgstatetypegroups);
        unset($this->issues);
        unset($this->issuesByName);
        unset($this->issuesByCategory);
        $this->loadOptions();
        $this->loadCategories();
        $this->loadParties();
        $this->loadPledgestatetypes();
        $this->loadPledgestatetypegroups();
    }
    
    public function loadContent() {
        $this->loadIssues();
        $this->isLoaded = true;
    }
    
    public function reloadContent() {
        $this->isLoad = false;
        unset($this->issues);
        unset($this->issuesByName);
        unset($this->issuesByCategory);
        $this->loadContent();
    }
    
    private function loadOptions() {
        $retar = $this->linkDB->Select("options");
        if (is_array($retar)) {
            foreach ($retar as $key => $val) {
                $this->options[$val->key] = $val->value;
            }
        }
    }
    
    private function loadParties() {
        $retar = $this->linkDB->Select("parties", "*", "ORDER BY `order` ASC");
        if (is_array($retar)) {
            foreach ($retar as $key => $val) {
                $this->parties[$val->id] = new Party($val->id, $val->name, $val->acronym, $val->colour, $val->programme_url, $val->programme_offset, $val->doValue, $val->order);
                $this->partiesByOrder[] = $this->parties[$val->id];
            }
        }
    }
    
    private function loadPledgestatetypes() {
        $retar = $this->linkDB->Select("pledgestatetypes");
        if (is_array($retar)) {
            foreach ($retar as $key => $val) {
                $this->pledgestatetypes[$val->id] = new Pledgestatetype($val->id, $val->name, $val->value, $val->multipl, $val->type, $val->order, $val->colour, $val->colour2);
            }
        }
    }
    
    private function loadPledgestatetypegroups() {
        $retar = $this->linkDB->Select("pledgestatetypegroups");
        if (is_array($retar)) {
            foreach ($retar as $key => $val) {
                $this->pledgestatetypegroups[$val->id] = new Pledgestatetypegroup($this, $val->id, $val->pledgestatetype_ids, $val->name, $val->colour);
            }
        }
    }
    
    
    private function loadCategories() {
        $retar = $this->linkDB->Select("categories", "*", "ORDER BY name ASC");
        if (is_array($retar)) {
            foreach ($retar as $key => $val) {
                $this->categories[$val->id] = new Category($val->id, $val->name, $val->disabled);
                ksort($this->categories);
                $this->categoriesByName[] = $this->categories[$val->id];
            }
        }
    }
    
    private function loadIssues() {
        if (!isset($this->filters['issues'])) {
            $retar = $this->linkDB->Select("issues", "*", "ORDER BY name ASC");
        } else {
            $retar = $this->linkDB->Select("issues", "*", "WHERE id IN (".implode(",", $this->filters['issues']).") ORDER BY name ASC");
        }
        if (is_array($retar)) {
            foreach ($retar as $key => $val) {
                
                if ((!is_array($this->filters['categories'])) || (count(array_intersect($this->filters['categories'], unserialize($val->category_ids))) > 0)) {
                    $this->issues[$val->id] = new Issue($this, $val->id, $val->name, $val->desc, $val->category_ids);
                    if (isset($this->filters['parties'])) {
                        $this->issues[$val->id]->setFilter("parties", $this->filters['parties']);
                    }
                    if (isset($this->filters['pledgestatetypeids'])) {
                        $this->issues[$val->id]->setFilter("pledgestatetypeids", $this->filters['pledgestatetypeids']);
                    }
                    $this->issues[$val->id]->loadContent();
                    if (((isset($this->filters['parties'])) || (isset($this->filters['pledgestatetypeids']))) && (count($this->issues[$val->id]->getPledges()) == 0)) {
                        unset($this->issues[$val->id]);
                    } else {
                        $this->issuesByName[] = $this->issues[$val->id];
                        foreach ($this->issues[$val->id]->getCategories() as $value) {
                            $this->issuesByCategory[$value->getID()][$val->id] = $this->issues[$val->id];
                        }
                    }
                }
                
            }
            ksort($this->issues);
        }
    }
    
    
    
    /* Getter-Funktionn */
    
    public function getCategories($order = "ID", $orient = "ASC") {
        switch ($order) {
         case "name":
            if ($orient == "ASC") {
                return $this->categoriesByName;
            } else {
                return array_reverse($this->categoriesByName);
            }
            break;
         default:
            return $this->categories;
        }
    }
    
    public function getCategory($id) {
        if (isset($this->categories[$id])) {
            return $this->categories[$id];
        } else {
            return null;
        }
    }
    
    public function getParties($order = "id", $orient = "ASC") {
        switch ($order) {
         case "order":
            if ($orient == "ASC") {
                return $this->partiesByOrder;
            } else {
                return array_reverse($this->partiesByOrder);
            }
            break;
         default:
            return $this->parties;
        }
        
    }
    
    public function getParty($id) {
        if (isset($this->parties[$id])) {
            return $this->parties[$id];
        } else {
            return null;
        }
    }    
    
    
    public function getPledgestatetypegroups() {
        if (is_array($this->pledgestatetypegroups)) {
            return $this->pledgestatetypegroups;
        } else {
            return false;
        }
    }  
    
    public function getPledgestatetypegroup($id) {
        if (isset($this->pledgestatetypegroups[$id])) {
            return $this->pledgestatetypegroups[$id];
        } else {
            return null;
        }
    }  
    
    public function getPledgestatetypes() {
        if (is_array($this->pledgestatetypes)) {
            return $this->pledgestatetypes;
        } else {
            return false;
        }
    }  
    
    public function getPledgestatetype($id) {
        if (isset($this->pledgestatetypes[$id])) {
            return $this->pledgestatetypes[$id];
        } else {
            return null;
        }
    } 

    public function getGroupsOfPledgestatetype($id) {
        if (isset($this->pledgestatetypes[$id]) && is_array($this->pledgestatetypegroups)) {
            foreach ($this->pledgestatetypegroups as $val) {
                if (in_array($id, $val->getPledgestatetypes())) {
                    $retar[] = $val->getID();
                }
            }
            return $retar;
        } else {
            return false;
        }
    }     
    
    public function getLinkDB() {
        return $this->linkDB;
    }
   
    
    public function getIssues($order = "id", $orient = "ASC") {
        switch ($order) {
         case "name":
            if ($orient == "ASC") {
                return $this->issuesByName;
            } else {
                return array_reverse($this->issuesByName);
            }
            break;
         case "category":
            return $this->issuesByCategory;
         default:
            return $this->issues;
        }
        
    }
   
    public function getIssue($id) {
        if (isset($this->issues[$id])) {
            return $this->issues[$id];
        } else {
            return false;
        }
        
    }
   
    public function getOptions() {
        if (is_array($this->options)) {
            return $this->options;
        } else {
            return false;
        }
    }
   
    public function getOption($key) {
        if (isset($this->options[$key])) {
            return $this->options[$key];
        } else {
            return false;
        }
    }
}

?>