<?php
$thiscustompageid = $adminactive['custompageid'];

$custompages = $dblink->Select("custompages", "*", "WHERE `id`=".(int)$thiscustompageid);

if (!isset($custompages[0])) {
    redirect(array("page" => "custompages_list"), null, "notfound");
}


    $thiscustompage = $custompages[0];
    if (!isset($oldarray)) {
        $oldarray['name'] = $thiscustompage->name;;
        $oldarray['content'] = $thiscustompage->content;
    }
    ?>

    <h2><?=_("Edit page");?></h2>
    <h3><?=_("Page");?> <?=$thiscustompage->id;?> – <?=$thiscustompage->name;?></h3>
    
    <form method="post">

    <? include ('custompages_form.php'); ?>

    <input type="hidden" name="do" value="custompages_edit" />
    <input type="hidden" name="custompages[id]" value="<?=$thiscustompageid;?>" />
    </form>
    

<hr /><p><a class="backlink button" href="<?=doadminlink("custompages_list", null, true);?>"><?=_("Back");?></a></p>