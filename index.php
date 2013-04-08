<?php
require("init.php");


ob_start();
require("interface/".KOM::$active['page'].".php");
$KOM_CONTENT = ob_get_contents();
ob_end_clean();


require("interface/header.php");
echo $KOM_CONTENT;
require("interface/footer.php");


?>