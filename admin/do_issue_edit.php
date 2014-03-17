<?php

$workarray = $_REQUEST['issue'];

$workarray['name'] = htmlspecialchars(trim($workarray['name']));
$workarray['desc'] = htmlspecialchars($workarray['desc']);
$workarray['comment'] = htmlspecialchars($workarray['comment']);

if (trim($workarray['name']) == "") $errors[] = _("issue");
if (!is_array($workarray['cat'])) $errors[] = _("category");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "issue_edit";
    $adminactive['issueid'] = $workarray['id'];
} else {
    if (!is_numeric($workarray['id']) || !$database->getIssue($workarray['id'])) {
        redirect(array("page" => "issue_list"), null, "notfound");
    }
    try {
        $dbarray['name'] = $workarray['name'];
        $dbarray['desc'] = $workarray['desc'];
        $dbarray['comment'] = $workarray['comment'];
        $dbarray['category_ids'] = serialize(array_keys($workarray['cat']));
        $dblink->Update("issues", $dbarray, "WHERE `id`=".(int)$workarray['id']);
        redirect(array("page" => "issue_list"), "edit");
    } catch (DBError $e) {
        redirect(array("page" => "issue_list"), null, "db");
    }

}



?>