<?php
$workarray = $_REQUEST['user'];
$thisuserid = $workarray['id'];
$users = $dblink->Select("users", "*", "WHERE `id`=".(int)$thisuserid);

if (!isset($_POST['submit_del'])) {
    redirect(array("page" => "user_list"));
}
if (!isset($users[0])) {
    redirect(array("page" => "user_list"), null, "notfound");
}


try {
    $dblink->Delete("users", "WHERE `id`=".(int)$thisuserid);
 
    
    redirect(array("page" => "user_list"), "del");
} catch (DBError $e) {
    redirect(array("page" => "user_list"), null, "db");
}





?>