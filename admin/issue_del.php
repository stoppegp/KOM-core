<?php
$thisissueid = $adminactive['issueid'];
if (!is_numeric($thisissueid) || !$database->getIssue($thisissueid)) {
    redirect(array("page" => "issue_list"), null, "notfound");
}

    $thisissue = $database->getIssue($thisissueid);


?>
    <h2><?=_("Delete issue");?></h2>
    <h3><?=_("Issue");?> <?=$thisissue->getID();?> – <?=$thisissue->getName();?></h3>
<form method="post">

<p style="color:red;"><?=_("Do you really want to delete this entry? This operation can't be undone!");?></p>

<input type="submit" name="submit_del" value="<?=_("Yes, delete!");?>" />
<input type="submit" value="<?=_("No");?>" />

<input type="hidden" name="do" value="issue_del" />
<input type="hidden" name="issue[id]" value="<?=$thisissueid;?>" />
</form>
<hr /><p><a class="backlink button" href="<?=doadminlink("issue_list", null, true);?>"><?=_("Back");?></a></p>