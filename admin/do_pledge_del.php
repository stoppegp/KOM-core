<?php

$workarray = $_REQUEST['pledge'];

if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "issue_show";
} else {

    try {
        $dblink->Delete("pledges", "WHERE `id`=".$workarray['id']);
        $dblink->Delete("pledgestates", "WHERE `pledge_id`=".$workarray['id']);
        
        $adminactive['page'] = "issue_show";
        adminaddsuccess(_("Deletion successful."));
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>