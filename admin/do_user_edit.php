<?php

$workarray = $_REQUEST['user'];

$workarray['name']  = trim($workarray['name']);
$workarray['username']  = trim($workarray['username']);

if (trim($workarray['name']) == "") $errors[] = "Name";
if (trim($workarray['username']) == "") $errors[] = "Benutzername";
if ($workarray['password'] != $workarray['password2']) $errors[] = "Passwort";

$temp01 = $dblink->Select("users", "*", "WHERE `username`='".trim($workarray['username'])."' AND `id`<>".$workarray['id']);

if (count($temp01) >0) $errors[] = "Der Benutzername ist schon vergeben.";

if (is_array($errors)) {
    adminadderror("Folgende Felder wurden nicht korrekt ausgefüllt: ".implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "user_edit";
} else {
    try {
        $dbarray['name'] = trim($workarray['name']);
        $dbarray['username'] = trim($workarray['username']);
        $dbarray['email'] = trim($workarray['email']);
        if ($workarray['admin'] == 1) {
            $dbarray['admin'] = 1;
        } else {
            $dbarray['admin'] = 0;
        }
        if ($workarray['password'] != "") {
            $dbarray['password'] = sha1($workarray['password']);
        }
        $dblink->Update("users", $dbarray, "WHERE `id`=".$workarray['id']);
        $adminactive['page'] = "user_list";
        adminaddsuccess("Benutzer wurde erfolgreich bearbeitet.");
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>