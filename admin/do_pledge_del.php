<?php

$workarray = $_REQUEST['pledge'];

if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "issue_show";
} else {

    try {
        $dblink->Delete("pledges", "WHERE `id`=".(int)$workarray['id']);
        $dblink->Delete("pledgestates", "WHERE `pledge_id`=".(int)$workarray['id']);
        
        redirect(array("page" => "issue_show", "issueid" => $adminactive['issueid']), "del");
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>