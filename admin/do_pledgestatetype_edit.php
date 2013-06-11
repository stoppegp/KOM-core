<?php

$workarray = $_REQUEST['pledgestatetype'];

$workarray['name']  = htmlspecialchars(trim($workarray['name']));
$workarray['colour']  = htmlspecialchars(trim($workarray['colour']));
$workarray['colour2']  = htmlspecialchars(trim($workarray['colour2']));
$workarray['value']  = (int) $workarray['value'];
$workarray['multipl']  = (int) $workarray['multipl'];
$workarray['type']  = (int) $workarray['type'];
$workarray['order']  = (int) $workarray['order'];

if (trim($workarray['name']) == "") $errors[] = _("label");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "pledgestatetype_edit";
} else {
    try {
        $dbarray['name'] = $workarray['name'];
        $dbarray['colour'] = $workarray['colour'];
        $dbarray['colour2'] = $workarray['colour2'];
        if (is_numeric($workarray['order'])) {
            $dbarray['order'] = $workarray['order'];
        } else {
            $dbarray['order'] = 0;
        }
        if (is_numeric($workarray['value'])) {
            $dbarray['value'] = $workarray['value'];
        } else {
            $dbarray['value'] = 0;
        }
        if ($workarray['multipl'] == 1) {
            $dbarray['multipl'] = 1;
        } else {
            $dbarray['multipl'] = 0;
        }
        $dblink->Update("pledgestatetypes", $dbarray, "WHERE `id`=".(int)$workarray['id']);
        redirect(array("page" => "pledgestatetype_list"), "edit");
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>