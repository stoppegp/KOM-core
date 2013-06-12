<?php

$workarray = $_REQUEST['party'];

$workarray['name']  = htmlspecialchars(trim($workarray['name']));
$workarray['acronym']  = htmlspecialchars(trim($workarray['acronym']));
$workarray['colour']  = htmlspecialchars(trim($workarray['colour']));
$workarray['programme_url']  = htmlspecialchars(trim($workarray['programme_url']));
$workarray['programme_name']  = htmlspecialchars(trim($workarray['programme_name']));
$workarray['programme_offset']  = (int) $workarray['programme_offset'];
$workarray['order']  = (int) $workarray['order'];
$workarray['doValue']  = (int) $workarray['doValue'];

if ($workarray['name'] == "") $errors[] = _("name");
if ($workarray['acronym'] == "") $errors[] = _("acronym");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "party_edit";
} else {
    $parties = $dblink->Select("parties", "*", "WHERE `id`=".(int)$workarray['id']);
    if (!isset($parties[0])) {
         redirect(array("page" => "party_list"), null, "notfound");
    }
    try {
        $dbarray['name'] = $workarray['name'];
        $dbarray['acronym'] = $workarray['acronym'];
        $dbarray['colour'] = $workarray['colour'];
        $dbarray['programme_url'] = $workarray['programme_url'];
        $dbarray['programme_name'] = $workarray['programme_name'];
        if (is_numeric($workarray['programme_offset'])) {
            $dbarray['programme_offset'] = $workarray['programme_offset'];
        } else {
            $dbarray['programme_offset'] = 0;
        }
        if (is_numeric($workarray['order'])) {
            $dbarray['order'] = $workarray['order'];
        } else {
            $dbarray['order'] = 0;
        }
        if ($workarray['doValue'] == 1) {
            $dbarray['doValue'] = 1;
        } else {
            $dbarray['doValue'] = 0;
        }
        $dblink->Update("parties", $dbarray, "WHERE `id`=".(int)$workarray['id']);
        redirect(array("page" => "party_list"), "edit");
    } catch (DBError $e) {
        redirect(array("page" => "party_list"), null, "db");
    }

}



?>