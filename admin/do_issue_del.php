<?php

$workarray = $_REQUEST['issue'];

if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "issue_list";
} else {

    try {
        $dblink->Delete("issues", "WHERE `id`=".$workarray['id']);
        $temp01 = $dblink->Select("pledges", "*", "WHERE `issue_id`=".$workarray['id']);
        
        $pledgeids = array();
        
        if (is_array($temp01)) {
            foreach ($temp01 as $key => $val) {
                $pledgeids[] = $val->id;
            }
        }
        $dblink->Delete("pledges", "WHERE `issue_id`=".$workarray['id']);
        $dblink->Delete("states", "WHERE `issue_id`=".$workarray['id']);
        if (is_array($pledgeids) && count($pledgeids) > 0) {
            $dblink->Delete("pledgestates", "WHERE `pledge_id` IN (".implode(",", $pledgeids).")");
        }
        
        
        $adminactive['page'] = "issue_list";
        adminaddsuccess("Datensatz wurde erfolgreich gelöscht.");
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>