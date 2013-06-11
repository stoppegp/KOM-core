<?php
$workarray = $_REQUEST['user'];
$thisuserid = $workarray['id'];



if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "user_list";
} else {

    try {
        $dblink->Delete("users", "WHERE `id`=".(int)$thisuserid);
     
        
        redirect(array("page" => "user_list"), "del");
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>