<?php

$workarray = $_REQUEST['issue'];

$workarray['name'] = htmlspecialchars(trim($workarray['name']));
$workarray['desc'] = htmlspecialchars($workarray['desc']);

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
        $dbarray['category_ids'] = serialize(array_keys($workarray['cat']));
        $dblink->Insert("issues", $dbarray);
        $adminactive['page'] = "issue_show";
        $adminactive['issueid'] = mysql_insert_id();
        adminaddsuccess(_("Added successfully."));
        $database->reloadContent();
    } catch (DBError $e) {
        aadminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>