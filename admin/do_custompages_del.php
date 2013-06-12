<?php
$workarray = $_REQUEST['custompages'];
$thiscustompageid = $workarray['id'];

$custompages = $dblink->Select("custompages", "*", "WHERE `id`=".(int)$thiscustompageid);

if (!isset($_POST['submit_del'])) {
    redirect(array("page" => "custompages_list"));
}
if (!isset($custompages[0])) {
    redirect(array("page" => "custompages_list"), null, "notfound");
}



try {
    $dblink->Delete("custompages", "WHERE `id`=".(int)$thiscustompageid);
    redirect(array("page" => "custompages_list"), "del");
} catch (DBError $e) {
    redirect(array("page" => "custompages_list"), null, "db");
}





?>