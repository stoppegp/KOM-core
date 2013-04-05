<?php

$workarray = $_REQUEST['pledge'];

if (trim($workarray['name']) == "") $errors[] = "Versprechen";
if (!is_numeric($workarray['party'])) $errors[] = "Partei";
if (!is_numeric($workarray['default_pledgestatetype'])) $errors[] = "Startinfo";
if (!in_array($workarray['party'], array_keys($database->getParties()))) $errors[] = "Partei";
if (!in_array($workarray['default_pledgestatetype'], array_keys($database->getPledgestatetypes()))) $errors[] = "Startinfo";
if (!in_array($workarray['issue_id'], array_keys($database->getIssues()))) $errors[] = "Thema";
if ($database->getPledgestatetype($workarray['default_pledgestatetype'])->getType() != $database->getIssue($workarray['issue_id'])->getPledge($workarray['id'])->getType()) $errors[] = "Zustand/Versprechen kann nicht verändert werden!";


if (is_array($errors)) {
    adminadderror("Folgende Felder wurden nicht korrekt ausgefüllt: ".implode(", ", $errors));
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
        adminaddsuccess("Datensatz wurde erfolgreich geändert.");
        $database->reloadContent();
    } catch (DBError $e) {
        adminadderror("Es gab einen Fehler mit der Datenbank. ".$e->getMessage());
    }

}



?>