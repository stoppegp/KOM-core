<?php
$workarray = $_REQUEST['cat'];

if (trim($workarray['name']) == "") $errors[] = _("Label");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "cat_edit";
} else {
    try {
        $dbarray['name'] = htmlspecialchars($workarray['name']);
        if ($workarray['disabled'] == 1) {
            $dbarray['disabled'] = 1;
        } else {
            $dbarray['disabled'] = 0;
        }
        $dblink->Update("categories", $dbarray, "WHERE `id`=".$workarray['id']);
        $adminactive['page'] = "cat_list";
        adminaddsuccess(_("Editing successful."));
        $database->reloadBasics();
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>