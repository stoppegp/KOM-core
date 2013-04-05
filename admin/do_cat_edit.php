<?php
$workarray = $_REQUEST['cat'];

if (trim($workarray['name']) == "") $errors[] = "Name";

if (is_array($errors)) {
    adminadderror("Folgende Felder wurden nicht korrekt ausgefüllt: ".implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "cat_edit";
} else {
    try {
        $dbarray['name'] = htmlspecialchars($workarray['name']);
        $dblink->Update("categories", $dbarray, "WHERE `id`=".$workarray['id']);
        $adminactive['page'] = "cat_list";
        adminaddsuccess("Datensatz wurde erfolgreich geändert.");
        $database->reloadBasics();
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>