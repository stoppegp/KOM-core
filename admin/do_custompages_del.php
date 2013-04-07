<?php
$workarray = $_REQUEST['custompages'];
$thiscustompageid = $workarray['id'];



if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "custompages_list";
} else {

    try {
        $dblink->Delete("custompages", "WHERE `id`=".$thiscustompageid);
     
        
        $adminactive['page'] = "custompages_list";
        adminaddsuccess("Seite wurde erfolgreich gelöscht.");
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>