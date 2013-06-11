<?php

$workarray = $_REQUEST['cat'];

$workarray['name'] = htmlspecialchars(trim($workarray['name']));
$workarray['disabled'] = (int) $workarray['disabled'];

if (trim($workarray['name']) == "") $errors[] = _("Label");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "cat_new";
} else {
    try {
        $dbarray['name'] = $workarray['name'];
        if ($workarray['disabled'] == 1) {
            $dbarray['disabled'] = 1;
        } else {
            $dbarray['disabled'] = 0;
        }
        $dblink->Insert("categories", $dbarray);
        $adminactive['page'] = "cat_list";
        adminaddsuccess(_("Added successfully."));
        $database->reloadBasics();
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>