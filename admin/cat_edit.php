<?php
$thiscatid = $adminactive['catid'];
if (!is_numeric($thiscatid) || !$database->getCategory($thiscatid)) {
    redirect(array("page" => "cat_list"), null, "notfound");
}
    $thiscat = $database->getCategory($thiscatid);
    
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


<hr /><p><a class="backlink button" href="<?=doadminlink("cat_list", null, true);?>"><?=_("Back");?></a></p>