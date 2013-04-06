<?php
require("init.php");
if (file_exists("interface/functions.php")) {
    require("interface/functions.php");
}

ob_start();
require("interface/".$active['page'].".php");
$KOM_CONTENT = ob_get_contents();
ob_end_clean();


require("interface/header.php");
echo $KOM_CONTENT;
require("interface/footer.php");


?>