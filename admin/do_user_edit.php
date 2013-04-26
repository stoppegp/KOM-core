<?php

$workarray = $_REQUEST['user'];

$workarray['name']  = trim($workarray['name']);
$workarray['username']  = trim($workarray['username']);

if (trim($workarray['name']) == "") $errors[] = _("name");
if (trim($workarray['username']) == "") $errors[] = _("username");
if ($workarray['password'] != $workarray['password2']) $errors[] = _("password");

$temp01 = $dblink->Select("users", "*", "WHERE `username`='".trim($workarray['username'])."' AND `id`<>".$workarray['id']);

if (count($temp01) >0) $errors[] = _("This username ist not available.");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
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
        adminaddsuccess(_("Editing successful."));
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>