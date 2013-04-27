<?php
$thispledgestatetypegroupid = $adminactive['pledgestatetypegroupid'];

$pledgestatetypegroups = $dblink->Select("pledgestatetypegroups", "*", "WHERE `id`=".$thispledgestatetypegroupid);

if (!$pledgestatetypegroups[0]) {
    echo _("Group-ID not found.");
} elseif (in_array($thispledgestatetypegroupid, array(1,2,3))) {
    echo _("This rating is pre-installed and cannot be deleted!");
} else {
    $thispledgestatetypegroup = $pledgestatetypegroups[0];
    

?>
    <h2><?=_("Group");?> <?=$thispledgestatetypegroup->id;?> – <?=$thispledgestatetypegroup->name;?></h3>
<form method="post">


<p style="color:red;"><?=_("Do you really want to delete this entry? This operation can't be undone!");?></p>

<input type="submit" name="submit_del" value="<?=_("Yes, delete!");?>" />
<input type="submit" value="<?=_("No");?>" />

<input type="hidden" name="do" value="pledgestatetypegroup_del" />
<input type="hidden" name="pledgestatetypegroup[id]" value="<?=$thispledgestatetypegroupid;?>" />
</form>
<hr /><p><a class="backlink button" href="<?=doadminlink("pledgestatetype_list");?>"><?=_("Back");?></a></p>
<?php
} 

?>