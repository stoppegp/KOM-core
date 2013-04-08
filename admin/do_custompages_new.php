<?php

$workarray = $_REQUEST['custompages'];

$workarray['name']  = trim($workarray['name']);

if (trim($workarray['name']) == "") $errors[] = "Name";

$temp01 = $dblink->Select("custompages", "*", "WHERE `name`='".trim($workarray['name'])."'");

if (count($temp01) >0) $errors[] = "Der Seitenname ist schon vergeben.";

if (is_array($errors)) {
    adminadderror("Folgende Felder wurden nicht korrekt ausgefüllt: ".implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "custompages_new";
} else {
    try {
        $dbarray['name'] = trim($workarray['name']);
        $dbarray['content'] = htmlspecialchars_decode($workarray['content']);
        $dblink->Insert("custompages", $dbarray);
        $adminactive['page'] = "custompages_list";
        adminaddsuccess("Seite wurde erfolgreich hinzugefügt.");
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>