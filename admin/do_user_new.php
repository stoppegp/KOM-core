<?php

$workarray = $_REQUEST['user'];

$workarray['name']  = trim($workarray['name']);
$workarray['username']  = trim($workarray['username']);

if (trim($workarray['name']) == "") $errors[] = "Name";
if (trim($workarray['username']) == "") $errors[] = "Benutzername";
if (trim($workarray['password']) == "") $errors[] = "Passwort";
if ($workarray['password'] != $workarray['password2']) $errors[] = "Passwort";

$temp01 = $dblink->Select("users", "*", "WHERE `username`='".trim($workarray['username'])."'");

if (count($temp01) >0) $errors[] = "Der Benutzername ist schon vergeben.";

if (is_array($errors)) {
    adminadderror("Folgende Felder wurden nicht korrekt ausgefüllt: ".implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "user_new";
} else {
    try {
        $dbarray['name'] = trim($workarray['name']);
        $dbarray['username'] = trim($workarray['username']);
        $dbarray['password'] = sha1($workarray['password']);
        if ($workarray['admin'] == 1) {
            $dbarray['admin'] = 1;
        } else {
            $dbarray['admin'] = 0;
        }
        $dblink->Insert("users", $dbarray);
        $adminactive['page'] = "user_list";
        adminaddsuccess("Benutzer wurde erfolgreich hinzugefügt.");
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>