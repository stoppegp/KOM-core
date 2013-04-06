<?php
require("init.php");
if (file_exists("theme/functions.php")) {
    require("theme/functions.php");
}

ob_start();
require("theme/".$active['page'].".php");
$KOM_CONTENT = ob_get_contents();
ob_end_clean();


require("theme/header.php");
echo $KOM_CONTENT;
require("theme/footer.php");


?>