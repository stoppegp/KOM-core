<?php
$thiscatid = $adminactive['catid'];
if (!$database->getCategory($thiscatid)) {
    echo _("Category ID not found.");
} else {
    $thiscat = &$database->getCategory($thiscatid);
    
    if (!isset($oldarray)) {
        $oldarray['name'] = $thiscat->getName();
        $oldarray['disabled'] = $thiscat->getDisabled();
    }


    ?>

    <h2><?=_("Edit category");?></h2>
    <h3><?=_("Category");?> <?=$thiscat->getID();?> – <?=$thiscat->getName();?></h3>
    
    <form method="post">

    <? include ('cat_form.php'); ?>

    <input type="hidden" name="do" value="cat_edit" />
    <input type="hidden" name="cat[id]" value="<?=$thiscatid;?>" />
    </form>
    
<?php
}
?>

<hr /><p><a class="backlink button" href="<?=doadminlink("cat_list");?>"><?=_("Back");?></a></p>