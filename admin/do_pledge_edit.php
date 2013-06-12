<?php

$workarray = $_REQUEST['pledge'];

$workarray['issue_id'] = (int) $workarray['issue_id'];
$workarray['name'] = htmlspecialchars(trim($workarray['name']));
$workarray['desc'] = htmlspecialchars($workarray['desc']);
$workarray['quotetext'] = htmlspecialchars($workarray['quotetext']);
$workarray['quotesource'] = htmlspecialchars(trim($workarray['quotesource']));
$workarray['quoteurl'] = htmlspecialchars(trim($workarray['quoteurl']));
$workarray['quotepage'] = htmlspecialchars(trim($workarray['quotepage']));
$workarray['default_pledgestatetype'] = (int) $workarray['default_pledgestatetype'];
$workarray['party'] = (int) $workarray['party'];

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
    $thisissueid = $workarray['issue_id'];
    $thispledgeid = $workarray['id'];
    if (!is_numeric($thisissueid) || !($database->getIssue($thisissueid))) {
        redirect(array("page" => "issue_list"), null, "notfound");
    }
    $thisissue = $database->getIssue($thisissueid);
    if (!is_numeric($thispledgeid) || !($thisissue->getPledge($thispledgeid))) {
        redirect(array("page" => "issue_show", "issueid" => $thisissueid), null, "notfound");
    }
    try {
        $dbarray['issue_id'] = $workarray['issue_id'];
        $dbarray['name'] = $workarray['name'];
        $dbarray['desc'] = $workarray['desc'];
        $dbarray['quotetext'] = $workarray['quotetext'];
        $dbarray['quotesource'] = $workarray['quotesource'];
        $dbarray['quoteurl'] = $workarray['quoteurl'];
        $dbarray['quotepage'] = $workarray['quotepage'];
        if ($dbarray['quotepage'] != "") {
            $dbarray['quotetype'] = "programme";
        } else {    
            $dbarray['quotetype'] = "link";
        }
        $dbarray['party_id'] = $workarray['party'];
        $dbarray['default_pledgestatetype_id'] = $workarray['default_pledgestatetype'];
        
        $dblink->Update("pledges", $dbarray, "WHERE `id`=".(int)$workarray['id']);
        
        redirect(array("page" => "issue_show", "issueid" => $thisissueid), "edit");
    } catch (DBError $e) {
        redirect(array("page" => "issue_show", "issueid" => $thisissueid), null, "db");
    }

}



?>