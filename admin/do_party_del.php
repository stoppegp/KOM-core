<?php
$workarray = $_REQUEST['party'];
$thispartyid = $workarray['id'];
$parties = $dblink->Select("parties", "*", "WHERE `id`=".(int)$thispartyid);

if (!isset($_POST['submit_del'])) {
    redirect(array("page" => "party_list"));
}
if (!isset($parties[0])) {
     redirect(array("page" => "party_list"), null, "notfound");
}

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
    redirect(array("page" => "party_list"), null, "db");
}




?>