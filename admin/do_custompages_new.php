<?php

$workarray = $_REQUEST['custompages'];

$workarray['name']  = htmlspecialchars(trim($workarray['name']));
$workarray['content']  = $workarray['content'];

if (trim($workarray['name']) == "") $errors[] = _("Label");

$temp01 = $dblink->Select("custompages", "*", "WHERE `name`='".trim($workarray['name'])."'");

if (count($temp01) >0) $errors[] = _("This label exists already.");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "custompages_new";
} else {
    try {
        $dbarray['name'] = $workarray['name'];
        $dbarray['content'] = $workarray['content'];
        $dblink->Insert("custompages", $dbarray);
        redirect(array("page" => "custompages_list"), "add");
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>