<?php
$thisissueid = $adminactive['issueid'];
$thisstateid = $adminactive['stateid'];
if (!$database->getIssue($thisissueid)) {
    echo "Die Issue-ID wurde nicht gefunden.";
} else {
    $thisissue = &$database->getIssue($thisissueid);
    
    if (!$thisissue->getState($thisstateid)) {
        echo "Die State-ID wurde nicht gefunden.";
    } else {
        $thisstate = $thisissue->getState($thisstateid);
?>
        <h2>Status löschen</h2>
        <h3>Thema <?=$thisissue->getID();?> – <?=$thisissue->getName();?></h3>
        <h3>Status <?=$thisstate->getID();?> – <?=$thisstate->getName();?></h3>
        <form method="post">

        <p style="color:red;">Soll dieser Eintrag wirklich gelöscht werden? Dieser Vorgang kann nicht rückgängig gemacht werden.</p>

        <input type="submit" name="submit_del" value="Ja, löschen!" />
        <input type="submit" value="Nein" />

        <input type="hidden" name="do" value="state_del" />
        <input type="hidden" name="state[issue_id]" value="<?=$thisissueid;?>" />
        <input type="hidden" name="state[id]" value="<?=$thisstateid;?>" />
        </form>
        <hr /><p><a class="backlink button" href="<?=doadminlink("issue_show");?>">Zurück</a></p>

<?php
    }
}
?>