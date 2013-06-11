<?php

$workarray = $_REQUEST['state'];

if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "issue_show";
} else {

    try {
        $dblink->Delete("states", "WHERE `id`=".(int)$workarray['id']);
        $dblink->Delete("pledgestates", "WHERE `state_id`=".(int)$workarray['id']);
        
        $adminactive['page'] = "issue_show";
        adminaddsuccess(_("Deletion successful."));
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>