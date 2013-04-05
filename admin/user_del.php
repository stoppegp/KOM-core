<?php

$thisuserid = $adminactive['userid'];
$users = $dblink->Select("users", "*", "WHERE `id`=".$thisuserid);

if (!$users[0]) {
    echo "Die User-ID wurde nicht gefunden.";
} else {
    $thisuser = $users[0];

?>
    <h2>Benutzer löschen</h2>
    <h3>Benutzer <?=$thisuser->id;?> – <?=$thisuser->username;?></h3>
<form method="post">

<p style="color:red;">Soll dieser Eintrag wirklich gelöscht werden? Dieser Vorgang kann nicht rückgängig gemacht werden.</p>

<input type="submit" name="submit_del" value="Ja, löschen!" />
<input type="submit" value="Nein" />

<input type="hidden" name="do" value="user_del" />
<input type="hidden" name="user[id]" value="<?=$thisuserid;?>" />
</form>
<hr /><p><a class="backlink button" href="<?=doadminlink("user_list");?>">Zurück</a></p>

<?php

}

?>