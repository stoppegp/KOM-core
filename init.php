<?php
require("config.php");

require('helpers/errorclasses.php');
require('helpers/MySQL.class.php');
require('classes/KOM.class.php');



require('autoload.php');
require('functions.php');
if (file_exists("interface/functions.php")) {
    require("interface/functions.php");
}

/* DB-Verbindung aufbauen */
KOM::$dblink = new MySQL(DB_HOST, DB_USER, DB_PASSWORD, DB_DBNAME);
KOM::$dblink->connect();

KOM::$mainDB = new Database(KOM::$dblink);


KOM::$pagetitle = KOM::$mainDB->getOption("site_title");

require("interface/init.php");

$uri = $_SERVER['REQUEST_URI'];
if (strpos("-".parse_url($uri, PHP_URL_PATH), parse_url(SITE_URL, PHP_URL_PATH)) == 1) {
    $uri = substr($uri, strlen(parse_url(SITE_URL, PHP_URL_PATH)));
}

KOM::$active = KOM::modrewrite($uri);


function dolink($page = "", $arg = null, $clear = false) {
    return KOM::dolink($page, $arg, $clear);
}
?>