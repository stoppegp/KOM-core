<?php

$workarray = $_REQUEST['cat'];

print_r($_POST);
//exit;

if (!isset($_POST['submit_del'])) {
    redirect(array("page" => "cat_list"));
}
if (!is_numeric($workarray['id']) || !$database->getCategory($workarray['id'])) {
    redirect(array("page" => "cat_list"), null, "notfound");
}
if (!is_numeric($workarray['newcat']) || !$database->getCategory($workarray['newcat'])) {
    redirect(array("page" => "cat_list"), null, "notfound");
}
if (count($database->getCategories()) < 2) {
    redirect(array("page" => "cat_list"), null, "last");
}

    

try {

    if (is_array($database->getIssues())) {
        foreach ($database->getIssues() as $val) {
            unset($catarray[$val->getID()]);
            $doit = false;
            foreach ($val->getCategories() as $val2) {
                if ($val2->getID() == $workarray['id']) {
                    $catarray[$val->getID()][] = $workarray['newcat'];
                    $doit = true;
                } else {
                     $catarray[$val->getID()][] = $val2->getID();
                }
            }
            if ($doit == true) {
                $dbarray['category_ids'] = serialize(array_unique($catarray[$val->getID()]));
                $dblink->Update("issues", $dbarray, "WHERE `id`=".(int)$val->getID());
            }
        }
    }
    
    $dblink->Delete("categories", "WHERE `id`=".(int)$workarray['id']);
    redirect(array("page" => "cat_list"), "del");
} catch (DBError $e) {
    redirect(array("page" => "cat_list"), null, "db");
}





?>