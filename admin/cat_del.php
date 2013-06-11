<?php
$thiscatid = $adminactive['catid'];
if (!$database->getCategory($thiscatid)) {
    echo _("Category ID not found.");
} elseif (count($database->getCategories()) < 2) {
    echo _("It ist impossible to delete the last category!");
} else {
    $thiscat = $database->getCategory($thiscatid);
    

?>
    <h2><?=_("Delete category");?></h2>
    <h3><?=_("Category");?> <?=$thiscat->getID();?> – <?=$thiscat->getName();?></h3>
<form method="post">

<p><?=_("Assign affected Issues to this category:");?></p>
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
<p style="color:red;"><?=_("Do you really want to delete this entry? This operation can't be undone!");?></p>

<input type="submit" name="submit_del" value="<?=_("Yes, delete!");?>" />
<input type="submit" value="<?=_("No");?>" />

<input type="hidden" name="do" value="cat_del" />
<input type="hidden" name="cat[id]" value="<?=$thiscatid;?>" />
</form>
<hr /><p><a class="backlink button" href="<?=doadminlink("cat_list", null, true);?>"><?=_("Back");?></a></p>
<?php
} 

?>