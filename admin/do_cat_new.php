<?php

$workarray = $_REQUEST['cat'];

if (trim($workarray['name']) == "") $errors[] = "Name";

if (is_array($errors)) {
    adminadderror("Folgende Felder wurden nicht korrekt ausgefüllt: ".implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "cat_new";
} else {
    try {
        $dbarray['name'] = htmlspecialchars($workarray['name']);
        $dblink->Insert("categories", $dbarray);
        $adminactive['page'] = "cat_list";
        adminaddsuccess("Datensatz wurde erfolgreich eingefügt.");
        $database->reloadBasics();
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>