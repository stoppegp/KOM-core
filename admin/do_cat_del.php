<?php

$workarray = $_REQUEST['cat'];

if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "cat_list";
} else {

    try {
        
        if (!$database->getCategory($workarray['newcat'])) exit;
    
        if (is_array($database->getIssues())) {
            foreach ($database->getIssues() as $val) {
                unset($catarray[$val->getID()]);
                $doit = false;
                foreach ($val->getCategoryLinks() as $val2) {
                    if ($val2->getID() == $workarray['id']) {
                        $catarray[$val->getID()][] = $workarray['newcat'];
                        $doit = true;
                    } else {
                         $catarray[$val->getID()][] = $val2->getID();
                    }
                }
                if ($doit == true) {
                    $dbarray['category_ids'] = serialize(array_unique($catarray[$val->getID()]));
                    $dblink->Update("issues", $dbarray, "WHERE `id`=".$val->getID());
                }
            }
        }
        
        $dblink->Delete("categories", "WHERE `id`=".$workarray['id']);

       
        $adminactive['page'] = "cat_list";
        adminaddsuccess("Datensatz wurde erfolgreich gelöscht.");
        $database->reloadBasics();
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>