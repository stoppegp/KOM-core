<?php
$workarray = $_REQUEST['party'];
$thispartyid = $workarray['id'];



if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "party_list";
} else {

    try {
        $dblink->Delete("parties", "WHERE `id`=".$thispartyid);
     
        $delids = $dblink->Select("pledges", "id", "WHERE `party_id`=".$thispartyid);
        $dblink->Delete("pledges", "WHERE `party_id`=".$thispartyid);
        
        if (is_array($delids)) {
            $delar = array();
            foreach ($delids as $val) {
                $delar[] = $val->id;
            }
            $dblink->Delete("pledgestates", "WHERE `pledge_id` IN (".implode(",", $delar).")");
        }
        
        
        $adminactive['page'] = "party_list";
        adminaddsuccess(_("Deletion successful."));
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>