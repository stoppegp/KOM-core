<?php
$thispledgestatetypeid = $adminactive['pledgestatetypeid'];

$pledgestatetypes = $dblink->Select("pledgestatetypes", "*", "WHERE `id`=".(int)$thispledgestatetypeid);
$pledgestates = $dblink->Select("pledgestates", "*", "WHERE `pledgestatetype_id`=".(int)$thispledgestatetypeid);
$pledges = $dblink->Select("pledges", "*", "WHERE `default_pledgestatetype_id`=".(int)$thispledgestatetypeid);

if (!$pledgestatetypes[0]) {
    echo _("Rating-ID not found.");
} elseif ((count($pledgestates) > 0) || (count($pledges) > 0)) {
    echo _("This rating is assigned to a state and cannot be deleted.");
} else {
    $thispledgestatetype = $pledgestatetypes[0];
    

?>
    <h2><?=_("Delete rating");?></h2>
    <h3><?=_("Rating");?> <?=$thispledgestatetype->id;?> – <?=$thispledgestatetype->name;?></h3>
<form method="post">


<p style="color:red;"><?=_("Do you really want to delete this entry? This operation can't be undone!");?></p>

<input type="submit" name="submit_del" value="<?=_("Yes, delete!");?>" />
<input type="submit" value="<?=_("No");?>" />

<input type="hidden" name="do" value="pledgestatetype_del" />
<input type="hidden" name="pledgestatetype[id]" value="<?=$thispledgestatetypeid;?>" />
</form>
<hr /><p><a class="backlink button" href="<?=doadminlink("pledgestatetype_list", null, true);?>"><?=_("Back");?></a></p>
<?php
} 

?>