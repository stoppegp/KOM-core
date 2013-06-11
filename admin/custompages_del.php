<?php

$thiscustompageid = $adminactive['custompageid'];

$custompages = $dblink->Select("custompages", "*", "WHERE `id`=".$thiscustompageid);

if (!$custompages[0]) {
    echo _("Page-ID not found.");
} else {
     $thiscustompage = $custompages[0];

?>
    <h2><?=_("Delete page");?></h2>
    <h3>><?=_("Page");?> <?=$thiscustompage->id;?> – <?=$thiscustompage->name;?></h3>
<form method="post">

<p style="color:red;"><?=_("Do you really want to delete this entry? This operation can't be undone!");?></p>

<input type="submit" name="submit_del" value="<?=_("Yes, delete!");?>" />
<input type="submit" value="<?=_("No");?>" />

<input type="hidden" name="do" value="custompages_del" />
<input type="hidden" name="custompages[id]" value="<?=$thiscustompageid;?>" />
</form>
<hr /><p><a class="backlink button" href="<?=doadminlink("custompages_list", null, true);?>"><?=_("Back");?></a></p>

<?php

}

?>