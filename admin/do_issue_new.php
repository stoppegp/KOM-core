<?php

$workarray = $_REQUEST['issue'];

if (trim($workarray['name']) == "") $errors[] = _("issue");
if (!is_array($workarray['cat'])) $errors[] = _("category");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "issue_new";
} else {
    try {
        $dbarray['name'] = htmlspecialchars($workarray['name']);
        $dbarray['desc'] = htmlspecialchars($workarray['desc']);
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