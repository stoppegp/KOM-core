<?php

$thispartyid = $adminactive['partyid'];
$parties = $dblink->Select("parties", "*", "WHERE `id`=".(int)$thispartyid);

if (!$parties[0]) {
     echo _("Party-ID not found.");
} else {
    $thisparty = $parties[0];

?>
    <h2><?=_("Delete Party");?></h2>
    <h3><?=_("Party");?> <?=$thisparty->id;?> – <?=$thisparty->name;?></h3>
<form method="post">

<p style="color:red;"><?=_("Do you really want to delete this entry? This operation can't be undone!");?></p>
<p style="color:red;"><strong><?=_("WARNING: All pledges of this party will be deleted!");?></strong></p>

<input type="submit" name="submit_del" value="<?=_("Yes, delete!");?>" />
<input type="submit" value="<?=_("No");?>" />

<input type="hidden" name="do" value="party_del" />
<input type="hidden" name="party[id]" value="<?=$thispartyid;?>" />
</form>
<hr /><p><a class="backlink button" href="<?=doadminlink("party_list", null, true);?>"><?=_("Back");?></a></p>

<?php

}

?>