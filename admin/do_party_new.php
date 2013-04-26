<?php

$workarray = $_REQUEST['party'];

$workarray['name']  = trim($workarray['name']);
$workarray['acronym']  = trim($workarray['acronym']);
$workarray['colour']  = trim($workarray['colour']);
$workarray['programme_url']  = trim($workarray['programme_url']);
$workarray['programme_name']  = trim($workarray['programme_name']);

if (trim($workarray['name']) == "") $errors[] = "Name";
if (trim($workarray['acronym']) == "") $errors[] = "Kürzel";



if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "party_new";
} else {
    try {
        $dbarray['name'] = trim($workarray['name']);
        $dbarray['acronym'] = trim($workarray['acronym']);
        $dbarray['colour'] = trim($workarray['colour']);
        $dbarray['programme_url'] = trim($workarray['programme_url']);
        $dbarray['programme_name'] = trim($workarray['programme_name']);
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
        $dblink->Insert("parties", $dbarray);
        $adminactive['page'] = "party_list";
        adminaddsuccess(_("Added successfully."));
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>