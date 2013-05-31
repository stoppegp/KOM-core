<?php

$workarray = $_REQUEST['pledge'];

if (trim($workarray['name']) == "") $errors[] = _("pledge");
if (!is_numeric($workarray['party'])) $errors[] = _("party");
if (!is_numeric($workarray['default_pledgestatetype'])) $errors[] = _("start info");
if (!in_array($workarray['party'], array_keys($database->getParties()))) $errors[] = _("party");
if (!in_array($workarray['default_pledgestatetype'], array_keys($database->getPledgestatetypes()))) $errors[] = _("start info");
if (!in_array($workarray['issue_id'], array_keys($database->getIssues()))) $errors[] = _("issue");
if ($database->getPledgestatetype($workarray['default_pledgestatetype'])->getType() != $database->getIssue($workarray['issue_id'])->getPledge($workarray['id'])->getType()) $errors[] = _("It is impossible to change the type")." ("._("request")."/"._("status quo").") "._("of the pledge!");


if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "pledge_edit";
} else {
    try {
        $dbarray['issue_id'] = $workarray['issue_id'];
        $dbarray['name'] = htmlspecialchars($workarray['name']);
        $dbarray['desc'] = htmlspecialchars($workarray['desc']);
        $dbarray['quotetext'] = htmlspecialchars($workarray['quotetext']);
        $dbarray['quotesource'] = htmlspecialchars($workarray['quotesource']);
        $dbarray['quoteurl'] = htmlspecialchars($workarray['quoteurl']);
        $dbarray['quotepage'] = htmlspecialchars($workarray['quotepage']);
        if ($dbarray['quotepage'] != "") {
            $dbarray['quotetype'] = "programme";
        } else {    
            $dbarray['quotetype'] = "link";
        }
        $dbarray['party_id'] = $workarray['party'];
        $dbarray['default_pledgestatetype_id'] = $workarray['default_pledgestatetype'];
        
        $dblink->Update("pledges", $dbarray, "WHERE `id`=".$workarray['id']);
        
        $adminactive['page'] = "issue_show";
        adminaddsuccess(_("Editing successful."));
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror(_("There was a database problem.").$e->getMessage());
    }

}



?>