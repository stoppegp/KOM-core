<?php
$thispledgestatetypegroupid = $adminactive['pledgestatetypegroupid'];
$pledgestatetypegroups = $dblink->Select("pledgestatetypegroups", "*", "WHERE `id`=".(int)$thispledgestatetypegroupid);

if (!isset($pledgestatetypegroups[0])) {
    redirect(array("page" => "pledgestatetype_list"), null, "notfound");
}

    $thispledgestatetypegroup = $pledgestatetypegroups[0];
    if (!isset($oldarray)) {
        $oldarray['name'] = $thispledgestatetypegroup->name;
        $oldarray['colour'] = $thispledgestatetypegroup->colour;
        $oldarray['order'] = $thispledgestatetypegroup->order;
        $temp0 = unserialize($thispledgestatetypegroup->pledgestatetype_ids);
        
        if (is_array($temp0)) {
            foreach ($temp0 as $value) {
                $oldarray['pledgestatetype_ids'][$value] = 1;
            }
        }
         
    }
    ?>

    <h2><?=_("Edit group");?></h2>
    <h3><?=_("Group");?> <?=$thispledgestatetypegroup->id;?> – <?=$thispledgestatetypegroup->name;?></h3>
    
    <form method="post">

    <? include (dirname(__FILE__).'/pledgestatetypegroup_form.php'); ?>

    <input type="hidden" name="do" value="pledgestatetypegroup_edit" />
    <input type="hidden" name="pledgestatetypegroup[id]" value="<?=$thispledgestatetypegroupid;?>" />
    </form>
    

<hr /><p><a class="backlink button" href="<?=doadminlink("pledgestatetype_list", null, true);?>"><?=_("Back");?></a></p>