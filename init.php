<?php
require("config.php");

require('helpers/errorclasses.php');
require('helpers/MySQL.class.php');

require('autoload.php');
require('functions.php');

require("theme/init.php");

/* DB-Verbindung aufbauen */
$dblink = new MySQL(DB_HOST, DB_USER, DB_PASSWORD, DB_DBNAME);
$dblink->connect();

$active['page'] = $_GET['page'];

if ($active['page'] == "") {
    $active['page'] = "home";
}

if (!file_exists("theme/".$active['page'].".php")) {
    $active['page'] = "error/404";
}

$mainDB = new Database($dblink);

$KOM_PAGETITLE = $mainDB->getOption("site_title");

?>