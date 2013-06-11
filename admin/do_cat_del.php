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
                foreach ($val->getCategories() as $val2) {
                    if ($val2->getID() == $workarray['id']) {
                        $catarray[$val->getID()][] = $workarray['newcat'];
                        $doit = true;
                    } else {
                         $catarray[$val->getID()][] = $val2->getID();
                    }
                }
                if ($doit == true) {
                    $dbarray['category_ids'] = serialize(array_unique($catarray[$val->getID()]));
                    $dblink->Update("issues", $dbarray, "WHERE `id`=".(int)$val->getID());
                }
            }
        }
        
        $dblink->Delete("categories", "WHERE `id`=".(int)$workarray['id']);
        $adminactive['page'] = "cat_list";
        redirect(array("page" => "cat_list"), "del");
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>