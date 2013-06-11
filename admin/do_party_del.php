<?php
$workarray = $_REQUEST['party'];
$thispartyid = $workarray['id'];



if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "party_list";
} else {

    try {
        $dblink->Delete("parties", "WHERE `id`=".(int)$thispartyid);
     
        $delids = $dblink->Select("pledges", "id", "WHERE `party_id`=".(int)$thispartyid);
        $dblink->Delete("pledges", "WHERE `party_id`=".(int)$thispartyid);
        
        if (is_array($delids)) {
            $delar = array();
            foreach ($delids as $val) {
                $delar[] = $val->id;
            }
            $dblink->Delete("pledgestates", "WHERE `pledge_id` IN (".implode(",", array_map("intval", $delar)).")");
        }
        
        
        redirect(array("page" => "party_list"), "del");
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>