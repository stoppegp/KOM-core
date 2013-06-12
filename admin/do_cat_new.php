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
    if (!is_numeric($workarray['id']) || !$database->getCategory($workarray['id'])) {
        redirect(array("page" => "cat_list"), null, "notfound");
    }
    try {
        $dbarray['name'] = $workarray['name'];
        if ($workarray['disabled'] == 1) {
            $dbarray['disabled'] = 1;
        } else {
            $dbarray['disabled'] = 0;
        }
        $dblink->Insert("categories", $dbarray);
        $adminactive['page'] = "cat_list";
        redirect(array("page" => "cat_list"), "add");
    } catch (DBError $e) {
        redirect(array("page" => "cat_list"), null, "db");
    }

}



?>