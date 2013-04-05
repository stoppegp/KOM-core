<?php

$workarray = $_REQUEST['state'];

if (trim($workarray['name']) == "") $errors[] = "Text";
if (trim($workarray['quotetext']) == "") $errors[] = "Zitat";
if (trim($workarray['quotesource']) == "") $errors[] = "Zitatquelle";
if (!strtotime($workarray['datum'])) $errors[] = "Datum";
if (!in_array($workarray['issue_id'], array_keys($database->getIssues()))) $errors[] = "Thema";


if (is_array($errors)) {
    adminadderror("Folgende Felder wurden nicht korrekt ausgefüllt: ".implode(", ", $errors));
    $oldarray = $workarray;
    $adminactive['page'] = "state_new";
} else {
    try {
        $dbarray['issue_id'] = $workarray['issue_id'];
        $dbarray['name'] = htmlspecialchars($workarray['name']);
        $dbarray['datum'] = date("Y-m-d", strtotime($workarray['datum']));
        $dbarray['quotetext'] = htmlspecialchars($workarray['quotetext']);
        $dbarray['quotesource'] = htmlspecialchars($workarray['quotesource']);
        $dbarray['quoteurl'] = htmlspecialchars($workarray['quoteurl']);

        
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
        
        $adminactive['page'] = "issue_show";
        adminaddsuccess("Datensatz wurde erfolgreich eingefügt.");
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>