<?php
$thisissueid = $adminactive['issueid'];
if (!$database->getIssue($thisissueid)) {
    echo "Die Issue-ID wurde nicht gefunden.";
} else {
    $thisissue = &$database->getIssue($thisissueid);
    
}

?>
    <h2>Thema löschen</h2>
    <h3>Thema <?=$thisissue->getID();?> – <?=$thisissue->getName();?></h3>
<form method="post">

<p style="color:red;">Soll dieser Eintrag wirklich gelöscht werden? Dieser Vorgang kann nicht rückgängig gemacht werden.</p>

<input type="submit" name="submit_del" value="Ja, löschen!" />
<input type="submit" value="Nein" />

<input type="hidden" name="do" value="issue_del" />
<input type="hidden" name="issue[id]" value="<?=$thisissueid;?>" />
</form>
<hr /><p><a class="backlink button" href="<?=doadminlink("issue_list");?>">Zurück</a></p>