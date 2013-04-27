<?php

$workarray = $_REQUEST['pledgestatetypegroup'];

$workarray['name']  = trim($workarray['name']);

if (trim($workarray['name']) == "") $errors[] = _("label");

if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "pledgestatetypegroup_new";
} else {
    try {
        $dbarray['name'] = trim($workarray['name']);
        $dbarray['colour'] = trim($workarray['colour']);
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
        
        $dblink->Insert("pledgestatetypegroups", $dbarray);
        $adminactive['page'] = "pledgestatetype_list";
        adminaddsuccess(_("Added successfully."));
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>