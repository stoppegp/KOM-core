<?php

$workarray = $_REQUEST['state'];

$workarray['issue_id'] = (int) $workarray['issue_id'];
$workarray['name'] = htmlspecialchars(trim($workarray['name']));
$workarray['datum'] = htmlspecialchars($workarray['datum']);
$workarray['quotetext'] = htmlspecialchars($workarray['quotetext']);
$workarray['quotesource'] = htmlspecialchars(trim($workarray['quotesource']));
$workarray['quoteurl'] = htmlspecialchars(trim($workarray['quoteurl']));
$workarray['pledges'] = array_map("intval", $workarray['pledges']);

if (trim($workarray['name']) == "") $errors[] = _("text");
if (trim($workarray['quotetext']) == "") $errors[] = _("quote");
if (trim($workarray['quotesource']) == "") $errors[] = _("quote source");
if (!strtotime($workarray['datum'])) $errors[] = _("date");
if (!in_array($workarray['issue_id'], array_keys($database->getIssues()))) $errors[] = _("issue");


if (is_array($errors)) {
    adminadderror(_("These fields have been filled in incorrectly: ").implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "state_new";
} else {
    $thisissueid = $workarray['issue_id'];
    if (!is_numeric($thisissueid) || !($database->getIssue($thisissueid))) {
        redirect(array("page" => "issue_list"), null, "notfound");
    }
    $thisissue = $database->getIssue($thisissueid);
    try {
        $dbarray['issue_id'] = $workarray['issue_id'];
        $dbarray['name'] = $workarray['name'];
        $dbarray['datum'] = date("Y-m-d", strtotime($workarray['datum']));
        $dbarray['quotetext'] = $workarray['quotetext'];
        $dbarray['quotesource'] = $workarray['quotesource'];
        $dbarray['quoteurl'] = $workarray['quoteurl'];

        
        $dblink->Insert("states", $dbarray);
        
        $newid = mysql_insert_id();
        
        if (is_array($database->getIssue($workarray['issue_id'])->getPledges())) {
            foreach ($database->getIssue($workarray['issue_id'])->getPledges() as $value) {
                unset($dbarray);
                $dbarray['pledge_id'] = $value->getID();
                $dbarray['state_id'] = $newid;
                $dbarray['pledgestatetype_id'] = 0;
                if (in_array($workarray['pledges'][$value->getID()], array_keys($database->getPledgestatetypes()) )) {
                    if ($database->getPledgestatetype($workarray['pledges'][$value->getID()])->getType() == $value->getType()) {
                         $dbarray['pledgestatetype_id'] = $workarray['pledges'][$value->getID()];
                    }
                }
                
                $dblink->Insert("pledgestates", $dbarray);
            }
        }
        
        redirect(array("page" => "issue_show", "issueid" => $adminactive['issueid']), "add");
    } catch (DBError $e) {
        redirect(array("page" => "issue_show", "issueid" => $thisissueid), null, "db");
    }

}



?>