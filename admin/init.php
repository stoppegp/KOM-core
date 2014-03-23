<?php
require('../classes/KOM.class.php');
require("../config.php");

require('../helpers/errorclasses.php');
require('../helpers/MySQL.class.php');


require('../autoload.php');
require_once('../helpers/gettext/gettext.inc');

if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}


/* DB-Verbindung aufbauen */
KOM::$dblink = new MySQL(DB_HOST, DB_USER, DB_PASSWORD, DB_DBNAME, DB_PREFIX);
KOM::$dblink->connect();

$dblink = &KOM::$dblink;

if (isset($_GET['party'])) $active['party'] = $_GET['party'];
if (isset($_GET['cat'])) $active['cat'] = $_GET['cat'];
if (isset($_GET['pst'])) $active['pst'] = $_GET['pst'];
if (isset($_GET['issueid'])) $active['issueid'] = $_GET['issueid'];

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