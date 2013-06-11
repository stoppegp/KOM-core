<?php
$thiscustompageid = $adminactive['custompageid'];

$custompages = $dblink->Select("custompages", "*", "WHERE `id`=".$thiscustompageid);

if (!$custompages[0]) {
    echo _("Page-ID not found.");
} else {
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
    
<?php
}
?>

<hr /><p><a class="backlink button" href="<?=doadminlink("custompages_list", null, true);?>"><?=_("Back");?></a></p>