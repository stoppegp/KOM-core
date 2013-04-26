<?php

$thispartyid = $adminactive['partyid'];
$parties = $dblink->Select("parties", "*", "WHERE `id`=".$thispartyid);

if (!$parties[0]) {
    echo "Die Partei-ID wurde nicht gefunden.";
} else {
    $thisparty = $parties[0];

?>
    <h2>Partei löschen</h2>
    <h3>Partei <?=$thisparty->id;?> – <?=$thisparty->name;?></h3>
<form method="post">

<p style="color:red;">Soll dieser Eintrag wirklich gelöscht werden? Dieser Vorgang kann nicht rückgängig gemacht werden.</p>
<p style="color:red;"><strong>ACHTUNG: Es werden auch sämtliche Versprechen dieser Partei unwiderruflich gelöscht!</strong></p>

<input type="submit" name="submit_del" value="Ja, löschen!" />
<input type="submit" value="Nein" />

<input type="hidden" name="do" value="party_del" />
<input type="hidden" name="party[id]" value="<?=$thispartyid;?>" />
</form>
<hr /><p><a class="backlink button" href="<?=doadminlink("party_list");?>">Zurück</a></p>

<?php

}

?>