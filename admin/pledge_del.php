<?php
$thisissueid = $adminactive['issueid'];
$thispledgeid = $adminactive['pledgeid'];
 if (!is_numeric($thisissueid) || !($database->getIssue($thisissueid))) {
    redirect(array("page" => "issue_list"), null, "notfound");
 }
 $thisissue = $database->getIssue($thisissueid);
 if (!is_numeric($thispledgeid) || !($thisissue->getPledge($thispledgeid))) {
    redirect(array("page" => "issue_show", "issueid" => $thisissueid), null, "notfound");
 }
        $thispledge = $thisissue->getPledge($thispledgeid);
?>
        <h2><?=_("Delete Promise");?></h2>
        <h3><?=_("Issue");?> <?=$thisissue->getID();?> – <?=$thisissue->getName();?></h3>
        <h3><?=_("Promise");?> <?=$thispledge->getID();?> – <?=$thispledge->getName();?></h3>
        <form method="post">

        <p style="color:red;"><?=_("Do you really want to delete this entry? This operation can't be undone!");?></p>

        <input type="submit" name="submit_del" value="<?=_("Yes, delete!");?>" />
        <input type="submit" value="<?=_("No");?>" />

        <input type="hidden" name="do" value="pledge_del" />
        <input type="hidden" name="pledge[issue_id]" value="<?=$thisissueid;?>" />
        <input type="hidden" name="pledge[id]" value="<?=$thispledgeid;?>" />
        </form>
        <hr /><p><a class="backlink button" href="<?=doadminlink("issue_show", array("issueid" => $adminactive['issueid']), true);?>"><?=_("Back");?></a></p>
