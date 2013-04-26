<?php
$workarray = $_REQUEST['user'];
$thisuserid = $workarray['id'];



if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "user_list";
} else {

    try {
        $dblink->Delete("users", "WHERE `id`=".$thisuserid);
     
        
        $adminactive['page'] = "user_list";
        adminaddsuccess(_("Deletion successful."));
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>