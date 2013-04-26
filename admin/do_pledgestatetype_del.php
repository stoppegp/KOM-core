<?php
$workarray = $_REQUEST['pledgestatetype'];
$thispledgestatetypeid = $workarray['id'];

$pledgestates = $dblink->Select("pledgestates", "*", "WHERE `pledgestatetype_id`=".$thispledgestatetypeid);
$pledges = $dblink->Select("pledges", "*", "WHERE `default_pledgestatetype_id`=".$thispledgestatetypeid);

if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "pledgestatetype_list";
} elseif ((count($pledgestates) > 0) || (count($pledges) > 0)) {
    $adminactive['page'] = "pledgestatetype_list";
} else {

    try {
        $dblink->Delete("pledgestatetypes", "WHERE `id`=".$thispledgestatetypeid);
     
        
        $adminactive['page'] = "pledgestatetype_list";
        adminaddsuccess("Bewertung wurde erfolgreich gelöscht.");
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>