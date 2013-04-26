<?php

$workarray = $_REQUEST['pledgestatetype'];

$workarray['name']  = trim($workarray['name']);

if (trim($workarray['name']) == "") $errors[] = "Bezeichnung";

if (is_array($errors)) {
    adminadderror("Folgende Felder wurden nicht korrekt ausgefüllt: ".implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "pledgestatetype_edit";
} else {
    try {
        $dbarray['name'] = trim($workarray['name']);
        $dbarray['colour'] = trim($workarray['colour']);
        $dbarray['colour2'] = trim($workarray['colour2']);
        if (is_numeric($workarray['order'])) {
            $dbarray['order'] = $workarray['order'];
        } else {
            $dbarray['order'] = 0;
        }
        if (is_numeric($workarray['value'])) {
            $dbarray['value'] = $workarray['value'];
        } else {
            $dbarray['value'] = 0;
        }
        if ($workarray['multipl'] == 1) {
            $dbarray['multipl'] = 1;
        } else {
            $dbarray['multipl'] = 0;
        }
        $dblink->Update("pledgestatetypes", $dbarray, "WHERE `id`=".$workarray['id']);
        $adminactive['page'] = "pledgestatetype_list";
        adminaddsuccess("Bewertung wurde erfolgreich bearbeitet.");
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>