<?php
$thisissueid = $adminactive['issueid'];
$thispledgeid = $adminactive['pledgeid'];
if (!$database->getIssue($thisissueid)) {
    echo "Die Issue-ID wurde nicht gefunden.";
} else {
    $thisissue = &$database->getIssue($thisissueid);
    
    if (!$thisissue->getPledge($thispledgeid)) {
        echo "Die Pledge-ID wurde nicht gefunden.";
    } else {
        $thispledge = $thisissue->getPledge($thispledgeid);
?>
        <h2>Versprechen löschen</h2>
        <h3>Thema <?=$thisissue->getID();?> – <?=$thisissue->getName();?></h3>
        <h3>Versprechen <?=$thispledge->getID();?> – <?=$thispledge->getName();?></h3>
        <form method="post">

        <p style="color:red;">Soll dieser Eintrag wirklich gelöscht werden? Dieser Vorgang kann nicht rückgängig gemacht werden.</p>

        <input type="submit" name="submit_del" value="Ja, löschen!" />
        <input type="submit" value="Nein" />

        <input type="hidden" name="do" value="pledge_del" />
        <input type="hidden" name="pledge[issue_id]" value="<?=$thisissueid;?>" />
        <input type="hidden" name="pledge[id]" value="<?=$thispledgeid;?>" />
        </form>
        <hr /><p><a class="backlink button" href="<?=doadminlink("issue_show");?>">Zurück</a></p>

<?php
    }
}
?>