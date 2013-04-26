<?php

$workarray = $_REQUEST['custompages'];

$workarray['name']  = trim($workarray['name']);

$temp01 = $dblink->Select("custompages", "*", "WHERE `name`='".trim($workarray['name'])."' AND `id`<>".$workarray['id']);

if (count($temp01) >0) $errors[] = _("This label exists already.");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "custompages_edit";
} else {
    try {
        $dbarray['name'] = trim($workarray['name']);
        $dbarray['content'] = htmlspecialchars_decode($workarray['content']);
        $dblink->Update("custompages", $dbarray, "WHERE `id`=".$workarray['id']);
        $adminactive['page'] = "custompages_list";
        adminaddsuccess(_("Editing successful."));
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>