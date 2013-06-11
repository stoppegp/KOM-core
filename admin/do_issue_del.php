<?php

$workarray = $_REQUEST['issue'];

if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "issue_list";
} else {

    try {
        $dblink->Delete("issues", "WHERE `id`=".(int)$workarray['id']);
        $temp01 = $dblink->Select("pledges", "*", "WHERE `issue_id`=".(int) $workarray['id']);
        
        $pledgeids = array();
        
        if (is_array($temp01)) {
            foreach ($temp01 as $key => $val) {
                $pledgeids[] = $val->id;
            }
        }
        $dblink->Delete("pledges", "WHERE `issue_id`=".(int) $workarray['id']);
        $dblink->Delete("states", "WHERE `issue_id`=".(int) $workarray['id']);
        if (is_array($pledgeids) && count($pledgeids) > 0) {
            $dblink->Delete("pledgestates", "WHERE `pledge_id` IN (".implode(",", array_map("intval", $pledgeids)).")"); 
        }
        
        
        $adminactive['page'] = "issue_list";
        adminaddsuccess(_("Deletion successful."));
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>