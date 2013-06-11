<?php

$workarray = $_REQUEST['pledgestatetypegroup'];

$workarray['name']  = htmlspecialchars(trim($workarray['name']));
$workarray['colour']  = htmlspecialchars(trim($workarray['colour']));
$workarray['order']  = (int) $workarray['order'];

if (trim($workarray['name']) == "") $errors[] = _("label");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "pledgestatetypegroup_edit";
} else {
    try {
        $dbarray['name'] = $workarray['name'];
        $dbarray['colour'] = $workarray['colour'];
        if (is_numeric($workarray['order'])) {
            $dbarray['order'] = $workarray['order'];
        } else {
            $dbarray['order'] = 0;
        }
        
        $pledgestatetypes = $dblink->Select("pledgestatetypes");
        if (is_array($pledgestatetypes)) {
            $pstids = array();
            foreach ($pledgestatetypes as $value) {
                if ($workarray['pledgestatetype_ids'][$value->id] == 1) {
                    $pstids[] = $value->id;
                }
            }
            if (is_array($pstids)) {
                $dbarray['pledgestatetype_ids'] = serialize($pstids);
            }
        }
        $dblink->Update("pledgestatetypegroups", $dbarray, "WHERE `id`=".(int)$workarray['id']);
        redirect(array("page" => "pledgestatetype_list"), "edit");
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>