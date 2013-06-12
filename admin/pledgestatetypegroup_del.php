<?php
$thispledgestatetypegroupid = $adminactive['pledgestatetypegroupid'];

$pledgestatetypegroups = $dblink->Select("pledgestatetypegroups", "*", "WHERE `id`=".(int)$thispledgestatetypegroupid);

if (!isset($pledgestatetypegroups[0])) {
    redirect(array("page" => "pledgestatetype_list"), null, "notfound");
}
if (in_array($thispledgestatetypegroupid, array(1,2,3))) {
    redirect(array("page" => "pledgestatetype_list"), null, "ratingpreinstalled");
}

?>
    <h2><?=_("Group");?> <?=$thispledgestatetypegroup->id;?> – <?=$thispledgestatetypegroup->name;?></h3>
<form method="post">


<p style="color:red;"><?=_("Do you really want to delete this entry? This operation can't be undone!");?></p>

<input type="submit" name="submit_del" value="<?=_("Yes, delete!");?>" />
<input type="submit" value="<?=_("No");?>" />

<input type="hidden" name="do" value="pledgestatetypegroup_del" />
<input type="hidden" name="pledgestatetypegroup[id]" value="<?=$thispledgestatetypegroupid;?>" />
</form>
<hr /><p><a class="backlink button" href="<?=doadminlink("pledgestatetype_list", null, true);?>"><?=_("Back");?></a></p>