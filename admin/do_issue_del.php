<?php
$workarray = $_REQUEST['issue'];
$thisissueid = $workarray['id'];

if (!isset($_POST['submit_del'])) {
    redirect(array("page" => "issue_list"));
}

if (!is_numeric($thisissueid) || !$database->getIssue($thisissueid)) {
    redirect(array("page" => "issue_list"), null, "notfound");
}

try {
    $dblink->Delete("issues", "WHERE `id`=".(int)$thisissueid);
    $temp01 = $dblink->Select("pledges", "*", "WHERE `issue_id`=".(int) $thisissueid);
    
    $pledgeids = array();
    
    if (is_array($temp01)) {
        foreach ($temp01 as $key => $val) {
            $pledgeids[] = $val->id;
        }
    }
    $dblink->Delete("pledges", "WHERE `issue_id`=".(int) $thisissueid);
    $dblink->Delete("states", "WHERE `issue_id`=".(int) $thisissueid);
    if (is_array($pledgeids) && count($pledgeids) > 0) {
        $dblink->Delete("pledgestates", "WHERE `pledge_id` IN (".implode(",", array_map("intval", $pledgeids)).")"); 
    }
    
    redirect(array("page" => "issue_list"), "add");
} catch (DBError $e) {
    redirect(array("page" => "issue_list"), null, "db");
}





?>