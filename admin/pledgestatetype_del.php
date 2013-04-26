<?php
$thispledgestatetypeid = $adminactive['pledgestatetypeid'];

$pledgestatetypes = $dblink->Select("pledgestatetypes", "*", "WHERE `id`=".$thispledgestatetypeid);
$pledgestates = $dblink->Select("pledgestates", "*", "WHERE `pledgestatetype_id`=".$thispledgestatetypeid);
$pledges = $dblink->Select("pledges", "*", "WHERE `default_pledgestatetype_id`=".$thispledgestatetypeid);

if (!$pledgestatetypes[0]) {
    echo "Die Bewertungs-ID wurde nicht gefunden.";
} elseif ((count($pledgestates) > 0) || (count($pledges) > 0)) {
    echo "Diese Bewertung wird zur Zeit verwendet und kann nicht gelöscht werden.";
} else {
    $thispledgestatetype = $pledgestatetypes[0];
    

?>
    <h2>Bewertung löschen</h2>
    <h3>Bewertung <?=$thispledgestatetype->id;?> – <?=$thispledgestatetype->name;?></h3>
<form method="post">


<p style="color:red;">Soll dieser Eintrag wirklich gelöscht werden? Dieser Vorgang kann nicht rückgängig gemacht werden.</p>

<input type="submit" name="submit_del" value="Ja, löschen!" />
<input type="submit" value="Nein" />

<input type="hidden" name="do" value="pledgestatetype_del" />
<input type="hidden" name="pledgestatetype[id]" value="<?=$thispledgestatetypeid;?>" />
</form>
<hr /><p><a class="backlink button" href="<?=doadminlink("pledgestatetype_list");?>">Zurück</a></p>
<?php
} 

?>