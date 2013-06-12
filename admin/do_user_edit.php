<?php

$workarray = $_REQUEST['user'];

$workarray['name']  = htmlspecialchars(trim($workarray['name']));
$workarray['username']  = htmlspecialchars(trim($workarray['username']));
$workarray['email']  = htmlspecialchars(trim($workarray['email']));
$workarray['admin'] = (int) $workarray['admin'];

if (trim($workarray['name']) == "") $errors[] = _("name");
if (trim($workarray['username']) == "") $errors[] = _("username");
if ($workarray['password'] != $workarray['password2']) $errors[] = _("password");

$temp01 = $dblink->Select("users", "*", "WHERE `username`='".mysql_real_escape_string($workarray['username'])."' AND `id`<>".(int)$workarray['id']);

if (count($temp01) >0) $errors[] = _("This username ist not available.");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "user_edit";
} else {
    $thisuserid = $workarray['id'];
    $users = $dblink->Select("users", "*", "WHERE `id`=".(int)$thisuserid);
    if (!isset($users[0])) {
        redirect(array("page" => "user_list"), null, "notfound");
    }
    try {
        $dbarray['name'] = $workarray['name'];
        $dbarray['username'] = $workarray['username'];
        $dbarray['email'] = $workarray['email'];
        if ($workarray['admin'] == 1) {
            $dbarray['admin'] = 1;
        } else {
            $dbarray['admin'] = 0;
        }
        if ($workarray['password'] != "") {
            $dbarray['password'] = sha1($workarray['password']);
        }
        $dblink->Update("users", $dbarray, "WHERE `id`=".(int)$workarray['id']);
        redirect(array("page" => "user_list"), "edit");
    } catch (DBError $e) {
        redirect(array("page" => "user_list"), null, "db");
    }

}



?>