<?php
require("../config.php");

require('../helpers/errorclasses.php');
require('../helpers/MySQL.class.php');

require('../autoload.php');
require('../functions.php');


/* DB-Verbindung aufbauen */
$dblink = new MySQL(DB_HOST, DB_USER, DB_PASSWORD, DB_DBNAME);
$dblink->connect();


$active['party'] = $_GET['party'];
$active['cat'] = $_GET['cat'];
$active['pst'] = $_GET['pst'];
$active['issueid'] = $_GET['issueid'];

$mainDB = new Database($dblink);

?>