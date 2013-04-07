<?php

$thiscustompageid = $adminactive['custompageid'];

$custompages = $dblink->Select("custompages", "*", "WHERE `id`=".$thiscustompageid);

if (!$custompages[0]) {
    echo "Die Page-ID wurde nicht gefunden.";
} else {
     $thiscustompage = $custompages[0];

?>
    <h2>Seite löschen</h2>
    <h3>Seite <?=$thiscustompage->id;?> – <?=$thiscustompage->name;?></h3>
<form method="post">

<p style="color:red;">Soll dieser Eintrag wirklich gelöscht werden? Dieser Vorgang kann nicht rückgängig gemacht werden.</p>

<input type="submit" name="submit_del" value="Ja, löschen!" />
<input type="submit" value="Nein" />

<input type="hidden" name="do" value="custompages_del" />
<input type="hidden" name="custompages[id]" value="<?=$thiscustompageid;?>" />
</form>
<hr /><p><a class="backlink button" href="<?=doadminlink("custompages_list");?>">Zurück</a></p>

<?php

}

?>