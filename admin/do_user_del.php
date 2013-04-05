<?php
$workarray = $_REQUEST['user'];
$thisuserid = $workarray['id'];



if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "user_list";
} else {

    try {
        $dblink->Delete("users", "WHERE `id`=".$thisuserid);
     
        
        $adminactive['page'] = "user_list";
        adminaddsuccess("Benutzer wurde erfolgreich gelöscht.");
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>