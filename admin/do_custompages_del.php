<?php
$workarray = $_REQUEST['custompages'];
$thiscustompageid = $workarray['id'];



if (!isset($_REQUEST['submit_del'])) {
    $adminactive['page'] = "custompages_list";
} else {

    try {
        $dblink->Delete("custompages", "WHERE `id`=".(int)$thiscustompageid);
     
        
        $adminactive['page'] = "custompages_list";
        redirect(array("page" => "custompages_list"), "del");
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>