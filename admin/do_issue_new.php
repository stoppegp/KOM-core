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
    $adminactive['page'] = "issue_new";
} else {
    try {
        $dbarray['name'] = $workarray['name'];
        $dbarray['desc'] = $workarray['desc'];
        $dbarray['comment'] = $workarray['comment'];
        $dbarray['category_ids'] = serialize(array_keys($workarray['cat']));
        $dblink->Insert("issues", $dbarray);
        redirect(array("page" => "issue_show", "issueid" => mysql_insert_id()), "add");
    } catch (DBError $e) {
        redirect(array("page" => "issue_list"), null, "db");
    }

}



?>