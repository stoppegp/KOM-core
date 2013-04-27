<?php
$thisissueid = $adminactive['issueid'];
$thispledgeid = $adminactive['pledgeid'];
if (!$database->getIssue($thisissueid)) {
    echo _("Issue-ID not found.");
} else {
    $thisissue = &$database->getIssue($thisissueid);
    
    if (!$thisissue->getPledge($thispledgeid)) {
        echo _("Promise-ID not found.");
    } else {
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
        <hr /><p><a class="backlink button" href="<?=doadminlink("issue_show");?>"><?=_("Back");?></a></p>

<?php
    }
}
?>