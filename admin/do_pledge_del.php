<?php

$workarray = $_REQUEST['pledge'];
$thisissueid = $workarray['issue_id'];
$thispledgeid = $workarray['id'];


if (!isset($_POST['submit_del'])) {
    redirect(array("page" => "issue_show", "issueid" => $thisissueid));
}
if (!is_numeric($thisissueid) || !($database->getIssue($thisissueid))) {
    redirect(array("page" => "issue_list"), null, "notfound");
}
$thisissue = $database->getIssue($thisissueid);
if (!is_numeric($thispledgeid) || !($thisissue->getPledge($thispledgeid))) {
    redirect(array("page" => "issue_show", "issueid" => $thisissueid), null, "notfound");
}

try {
    $dblink->Delete("pledges", "WHERE `id`=".(int)$workarray['id']);
    $dblink->Delete("pledgestates", "WHERE `pledge_id`=".(int)$workarray['id']);
    
    redirect(array("page" => "issue_show", "issueid" => $thisissueid), "del");
} catch (DBError $e) {
    redirect(array("page" => "issue_show", "issueid" => $thisissueid), null, "db");
}





?>