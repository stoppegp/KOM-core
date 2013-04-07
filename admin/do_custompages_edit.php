<?php

$workarray = $_REQUEST['custompages'];

$workarray['name']  = trim($workarray['name']);


if (is_array($errors)) {
    adminadderror("Folgende Felder wurden nicht korrekt ausgefüllt: ".implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "custompages_edit";
} else {
    try {
        $dbarray['name'] = trim($workarray['name']);
        $dbarray['content'] = htmlspecialchars_decode($workarray['content']);
        $dblink->Update("custompages", $dbarray, "WHERE `id`=".$workarray['id']);
        $adminactive['page'] = "custompages_list";
        adminaddsuccess("Seite wurde erfolgreich bearbeitet.");
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>