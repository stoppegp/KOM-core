<?php
$thiscatid = $adminactive['catid'];
if (!$database->getCategory($thiscatid)) {
    echo "Die Cat-ID wurde nicht gefunden.";
} elseif (count($database->getCategories()) < 2) {
    echo "Die letzte Kategorie kann nicht gelöscht werden.";
} else {
    $thiscat = &$database->getCategory($thiscatid);
    

?>
    <h2>Kategorie löschen</h2>
    <h3>Kategorie <?=$thiscat->getID();?> – <?=$thiscat->getName();?></h3>
<form method="post">

<p>Welcher Kategorie sollen die zugehörigen Themen zugeordnet werden?</p>
<select name="cat[newcat]">
<?php
    foreach ($database->getCategories("name") as $val) {
        if ($val->getID() == $thiscatid) continue;
        ?>
        <option value="<?=$val->getID();?>">#<?=$val->getID();?>: <?=$val->getName();?></option>
        <?
    }

?>
</select>
<p style="color:red;">Soll dieser Eintrag wirklich gelöscht werden? Dieser Vorgang kann nicht rückgängig gemacht werden.</p>

<input type="submit" name="submit_del" value="Ja, löschen!" />
<input type="submit" value="Nein" />

<input type="hidden" name="do" value="cat_del" />
<input type="hidden" name="cat[id]" value="<?=$thiscatid;?>" />
</form>
<hr /><p><a class="backlink button" href="<?=doadminlink("cat_list");?>">Zurück</a></p>
<?php
} 

?>