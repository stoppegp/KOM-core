<?php

$workarray = $_REQUEST['state'];

if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "issue_show";
} else {

    try {
        $dblink->Delete("states", "WHERE `id`=".$workarray['id']);
        $dblink->Delete("pledgestates", "WHERE `state_id`=".$workarray['id']);
        
        $adminactive['page'] = "issue_show";
        adminaddsuccess("Datensatz wurde erfolgreich gelöscht.");
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>