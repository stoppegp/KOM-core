<?php
$workarray = $_REQUEST['pledgestatetype'];
$thispledgestatetypeid = $workarray['id'];

$pledgestates = $dblink->Select("pledgestates", "*", "WHERE `pledgestatetype_id`=".(int)$thispledgestatetypeid);
$pledges = $dblink->Select("pledges", "*", "WHERE `default_pledgestatetype_id`=".(int)$thispledgestatetypeid);

if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "pledgestatetype_list";
} elseif ((count($pledgestates) > 0) || (count($pledges) > 0)) {
    $adminactive['page'] = "pledgestatetype_list";
} else {

    try {
        $dblink->Delete("pledgestatetypes", "WHERE `id`=".(int)$thispledgestatetypeid);
     
        
        redirect(array("page" => "pledgestatetype_list"), "del");
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>