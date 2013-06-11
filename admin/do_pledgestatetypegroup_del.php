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
     
        
        redirect(array("page" => "pledgestatetype_list"), "del");
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>