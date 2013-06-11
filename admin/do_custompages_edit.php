<?php

$workarray = $_REQUEST['custompages'];

$workarray['name']  = htmlspecialchars(trim($workarray['name']));
$workarray['content']  = $workarray['content'];

$temp01 = $dblink->Select("custompages", "*", "WHERE `name`='".trim($workarray['name'])."' AND `id`<>".$workarray['id']);

if (count($temp01) >0) $errors[] = _("This label exists already.");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "custompages_edit";
} else {
    try {
        $dbarray['name'] = $workarray['name'];
        $dbarray['content'] = $workarray['content'];
        $dblink->Update("custompages", $dbarray, "WHERE `id`=".(int)$workarray['id']);
        redirect(array("page" => "custompages_list"), "edit");
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>