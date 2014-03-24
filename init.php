<?php
error_reporting(E_ALL ^ E_NOTICE);

require(dirname(__FILE__).'/helpers/errorclasses.php');
require(dirname(__FILE__).'/helpers/MySQL.class.php');
require(dirname(__FILE__).'/classes/KOM.class.php');
require(dirname(__FILE__).'/config.php');
require_once(dirname(__FILE__).'/helpers/gettext/gettext.inc');


require(dirname(__FILE__).'/autoload.php');

if (file_exists("interface/functions.php")) {
    require(dirname(__FILE__).'/interface/functions.php');
}

try {
/* DB-Verbindung aufbauen */
KOM::$dblink = new MySQL(DB_HOST, DB_USER, DB_PASSWORD, DB_DBNAME, DB_PREFIX);
KOM::$dblink->connect();

KOM::$mainDB = new Database(KOM::$dblink);
KOM::$pagetitle = KOM::$mainDB->getOption("site_title");
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
KOM::$site_url = $protocol.SITE_URL;

KOM::loadIssuelist();
KOM::loadCustompagelist();

if (file_exists('interface/init.php')) {
    require(dirname(__FILE__).'/interface/init.php');
}

$uri = $_SERVER['REQUEST_URI'];
if (strpos("-".parse_url($uri, PHP_URL_PATH), parse_url(KOM::$site_url, PHP_URL_PATH)) == 1) {
    $uri = substr($uri, strlen(parse_url(KOM::$site_url, PHP_URL_PATH)));
}

KOM::$active = KOM::urlrewrite($uri);
} catch (DBError $e) {
    echo "Die Datenbankverbindung schlug fehl.";
    exit;
}

function dolink($page = "", $arg = null, $clear = false) {
    return KOM::dolink($page, $arg, $clear);
}

$locale = "de_DE";
$domain = "kom_admin";
$encoding = "UTF-8";
putenv('LC_ALL=de_DE');
setlocale(LC_ALL, $locale);
bindtextdomain($domain, './interface/locale');
bind_textdomain_codeset($domain, $encoding);
textdomain($domain);

?>