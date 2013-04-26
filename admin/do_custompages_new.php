<?php

$workarray = $_REQUEST['custompages'];

$workarray['name']  = trim($workarray['name']);

if (trim($workarray['name']) == "") $errors[] = _("Label");

$temp01 = $dblink->Select("custompages", "*", "WHERE `name`='".trim($workarray['name'])."'");

if (count($temp01) >0) $errors[] = _("This label exists already.");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "custompages_new";
} else {
    try {
        $dbarray['name'] = trim($workarray['name']);
        $dbarray['content'] = htmlspecialchars_decode($workarray['content']);
        $dblink->Insert("custompages", $dbarray);
        $adminactive['page'] = "custompages_list";
        adminaddsuccess(_("Added successfully."));
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>