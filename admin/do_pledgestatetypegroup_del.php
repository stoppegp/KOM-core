<?php
$workarray = $_REQUEST['pledgestatetypegroup'];
$thispledgestatetypegroupid = $workarray['id'];

if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "pledgestatetype_list";
} elseif (in_array($thispledgestatetypegroupid, array(1,2,3))) {
    $adminactive['page'] = "pledgestatetype_list";
} else {

    try {
        $dblink->Delete("pledgestatetypegroups", "WHERE `id`=".(int)$thispledgestatetypegroupid);
     
        
        $adminactive['page'] = "pledgestatetype_list";
        adminaddsuccess(_("Deletion successful."));
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>