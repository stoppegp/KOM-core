<?php
$workarray = $_REQUEST['issue'];
$workarray = $_REQUEST['issue'];

if (trim($workarray['name']) == "") $errors[] = "Thema";
if (!is_array($workarray['cat'])) $errors[] = "Kategorie";

if (is_array($errors)) {
    adminadderror("Folgende Felder wurden nicht korrekt ausgefüllt: ".implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "issue_edit";
    $adminactive['issueid'] = $workarray['id'];
} else {
    try {
        $dbarray['name'] = htmlspecialchars($workarray['name']);
        $dbarray['desc'] = htmlspecialchars($workarray['desc']);
        $dbarray['category_ids'] = serialize(array_keys($workarray['cat']));
        $dblink->Update("issues", $dbarray, "WHERE `id`=".$workarray['id']);
        $adminactive['page'] = "issue_list";
        adminaddsuccess("Datensatz wurde erfolgreich geändert.");
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>