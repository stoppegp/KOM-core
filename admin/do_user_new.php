<?php

$workarray = $_REQUEST['user'];

$workarray['name']  = htmlspecialchars(trim($workarray['name']));
$workarray['username']  = htmlspecialchars(trim($workarray['username']));
$workarray['email']  = htmlspecialchars(trim($workarray['email']));
$workarray['admin'] = (int) $workarray['admin'];

if (trim($workarray['name']) == "") $errors[] = _("name");
if (trim($workarray['username']) == "") $errors[] = _("username");
if (trim($workarray['password']) == "") $errors[] = _("password");
if ($workarray['password'] != $workarray['password2']) $errors[] = _("password");

$temp01 = $dblink->Select("users", "*", "WHERE `username`='".trim($workarray['username'])."'");

if (count($temp01) >0) $errors[] = _("This username ist not available.");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "user_new";
} else {
    try {
        $dbarray['name'] = $workarray['name'];
        $dbarray['username'] = $workarray['username'];
        $dbarray['password'] = sha1($workarray['password']);
        $dbarray['email'] = $workarray['email'];
        if ($workarray['admin'] == 1) {
            $dbarray['admin'] = 1;
        } else {
            $dbarray['admin'] = 0;
        }
        $dblink->Insert("users", $dbarray);
        redirect(array("page" => "user_list"), "add");
    } catch (DBError $e) {
        redirect(array("page" => "user_list"), null, "db");
    }

}



?>