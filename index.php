<?php
require("init.php");


ob_start();
if (file_exists("interface/".KOM::$active['page'].".php")) {
    require("interface/".KOM::$active['page'].".php");
} elseif (file_exists("defaultpages/".KOM::$active['page'].".php")) {
    require("defaultpages/".KOM::$active['page'].".php");
}

$KOM_CONTENT = ob_get_contents();
ob_end_clean();


if (file_exists("interface/header.php")) {
    require("interface/header.php");
}
echo $KOM_CONTENT;
if (file_exists("interface/footer.php")) {
    require("interface/footer.php");
}


?>