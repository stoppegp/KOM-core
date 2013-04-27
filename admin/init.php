<?php
require('../classes/KOM.class.php');
require("../config.php");

require('../helpers/errorclasses.php');
require('../helpers/MySQL.class.php');


require('../autoload.php');
require_once('../helpers/gettext/gettext.inc');


/* DB-Verbindung aufbauen */
KOM::$dblink = new MySQL(DB_HOST, DB_USER, DB_PASSWORD, DB_DBNAME, DB_PREFIX);
KOM::$dblink->connect();

$dblink = &KOM::$dblink;

$active['party'] = $_GET['party'];
$active['cat'] = $_GET['cat'];
$active['pst'] = $_GET['pst'];
$active['issueid'] = $_GET['issueid'];

$mainDB = new Database(KOM::$dblink);
KOM::$pagetitle = $mainDB->getOption("site_title");

$locale = "de_DE";
$domain = "kom_admin";
$encoding = "UTF-8";
putenv('LC_ALL=de_DE');
setlocale(LC_ALL, $locale);
bindtextdomain($domain, './locale');
bind_textdomain_codeset($domain, $encoding);
textdomain($domain);

_("KOM");
?>