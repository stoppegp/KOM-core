<?php

$workarray = $_REQUEST['state'];

if (trim($workarray['name']) == "") $errors[] = _("text");
if (trim($workarray['quotetext']) == "") $errors[] = _("quote");
if (trim($workarray['quotesource']) == "") $errors[] = _("quote source");
if (!strtotime($workarray['datum'])) $errors[] = _("date");
if (!in_array($workarray['issue_id'], array_keys($database->getIssues()))) $errors[] = _("issue");


if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "state_edit";
} else {
    try {
        $dbarray['name'] = htmlspecialchars($workarray['name']);
        $dbarray['datum'] = date("Y-m-d", strtotime($workarray['datum']));
        $dbarray['quotetext'] = htmlspecialchars($workarray['quotetext']);
        $dbarray['quotesource'] = htmlspecialchars($workarray['quotesource']);
        $dbarray['quoteurl'] = htmlspecialchars($workarray['quoteurl']);

        
        $dblink->Update("states", $dbarray, "WHERE `id`=".$workarray['id']);
        $dblink->Delete("pledgestates", "WHERE `state_id`=".$workarray['id']);
        
        
        
        if (is_array($database->getIssue($workarray['issue_id'])->getPledges())) {
            foreach ($database->getIssue($workarray['issue_id'])->getPledges() as $value) {
                unset($dbarray);
                $dbarray['pledge_id'] = $value->getID();
                $dbarray['state_id'] = $workarray['id'];
                $dbarray['pledgestatetype_id'] = 0;
                if (in_array($workarray['pledges'][$value->getID()], array_keys($database->getPledgestatetypes()) )) {
                    if ($database->getPledgestatetype($workarray['pledges'][$value->getID()])->getType() == $value->getType()) {
                         $dbarray['pledgestatetype_id'] = $workarray['pledges'][$value->getID()];
                    }
                }
                
                $dblink->Insert("pledgestates", $dbarray);
            }
        }
        
        $adminactive['page'] = "issue_show";
        adminaddsuccess(_("Editing successful."));
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>