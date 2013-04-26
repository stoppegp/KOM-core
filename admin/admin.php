<?php

session_start();
require_once('init.php');
require_once('functions.php');

/* Adminactvive-Variablen */
$adminactive['page'] = $_REQUEST['page'];
if (isset($_REQUEST['do']) && $_REQUEST['do'] != "") $adminactive['do'] = $_REQUEST['do'];
if (isset($_REQUEST['issueid']) && $_REQUEST['issueid'] != "") $adminactive['issueid'] = $_REQUEST['issueid'];
if (isset($_REQUEST['pledgeid']) && $_REQUEST['pledgeid'] != "") $adminactive['pledgeid'] = $_REQUEST['pledgeid'];
if (isset($_REQUEST['stateid']) && $_REQUEST['stateid'] != "") $adminactive['stateid'] = $_REQUEST['stateid'];
if (isset($_REQUEST['userid']) && $_REQUEST['userid'] != "") $adminactive['userid'] = $_REQUEST['userid'];
if (isset($_REQUEST['catid']) && $_REQUEST['catid'] != "") $adminactive['catid'] = $_REQUEST['catid'];
if (isset($_REQUEST['custompageid']) && $_REQUEST['custompageid'] != "") $adminactive['custompageid'] = $_REQUEST['custompageid'];
if (isset($_REQUEST['partyid']) && $_REQUEST['partyid'] != "") $adminactive['partyid'] = $_REQUEST['partyid'];
if (isset($_REQUEST['pledgestatetypeid']) && $_REQUEST['pledgestatetypeid'] != "") $adminactive['pledgestatetypeid'] = $_REQUEST['pledgestatetypeid'];

/* AUTH */
require_once('auth.php');

/* Datenbank initialisieren */
$database = new Database($dblink);
$database->loadContent();

/* Erlaubte Seiten */
if (!in_array($adminactive['page'], array("login", "issue_list", "issue_new", "issue_edit", "issue_del", "issue_show", "pledge_new", "pledge_del", "pledge_edit", "state_new", "state_del", "state_edit", "user_list", "user_new", "user_edit", "user_del", "cat_list", "cat_edit", "cat_new", "cat_del", "cat_edit", "custompages_list", "custompages_new", "custompages_edit", "custompages_del", "party_list", "party_new", "party_edit", "party_del", "pledgestatetype_list", "pledgestatetype_new", "pledgestatetype_edit", "pledgestatetype_del"))) {
    $adminactive['page'] = "issue_list";
}

/* Erlaubte Aktionen */
if (in_array($adminactive['do'], array("issue_new", "issue_edit", "issue_del", "pledge_new", "pledge_del", "pledge_edit", "state_new", "state_del", "state_edit", "user_new", "user_edit", "user_del", "cat_new", "cat_del", "cat_edit", "custompages_new", "custompages_edit", "custompages_del", "party_new", "party_edit", "party_del", "pledgestatetype_new", "pledgestatetype_edit", "pledgestatetype_del"))) {
    // Aktion ausführen
    include ("do_".$adminactive['do'].".php");
}

include('header.php');

if (is_array($adminerrors)) {
    echo "<div class=\"adminerror\">".implode("</div><div class=\"adminerror\">", $adminerrors)."</div>";
}
if (is_array($adminsuccs)) {
    echo "<div class=\"adminsuccess\">".implode("</div><div>", $adminsuccs)."</div>";
}

include($adminactive['page'].".php");

include('footer.php');

?>