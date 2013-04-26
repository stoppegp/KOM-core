<?php
$workarray = $_REQUEST['issue'];
$workarray = $_REQUEST['issue'];

if (trim($workarray['name']) == "") $errors[] = _("issue");
if (!is_array($workarray['cat'])) $errors[] = _("category");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "issue_edit";
    $adminactive['issueid'] = $workarray['id'];
} else {
    try {
        $dbarray['name'] = htmlspecialchars($workarray['name']);
        $dbarray['desc'] = htmlspecialchars($workarray['desc']);
        $dbarray['category_ids'] = serialize(array_keys($workarray['cat']));
        $dblink->Update("issues", $dbarray, "WHERE `id`=".$workarray['id']);
        $adminactive['page'] = "issue_list";
        adminaddsuccess(_("Editing successful."));
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>