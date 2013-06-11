<?php
$thisissueid = $adminactive['issueid'];
$thisstateid = $adminactive['stateid'];
if (!$database->getIssue($thisissueid)) {
    echo _("Issue-ID not found.");
} else {
    $thisissue = &$database->getIssue($thisissueid);
    
    if (!$thisissue->getState($thisstateid)) {
        echo _("State-ID not found.");
    } else {
        $thisstate = $thisissue->getState($thisstateid);
?>
        <h2><?=_("Delete state");?></h2>
        <h3><?=_("Issue");?> <?=$thisissue->getID();?> – <?=$thisissue->getName();?></h3>
        <h3><?=_("State");?> <?=$thisstate->getID();?> – <?=$thisstate->getName();?></h3>
        <form method="post">

        <p style="color:red;"><?=_("Do you really want to delete this entry? This operation can't be undone!");?></p>

        <input type="submit" name="submit_del" value="<?=_("Yes, delete!");?>" />
        <input type="submit" value="<?=_("No");?>" />

        <input type="hidden" name="do" value="state_del" />
        <input type="hidden" name="state[issue_id]" value="<?=$thisissueid;?>" />
        <input type="hidden" name="state[id]" value="<?=$thisstateid;?>" />
        </form>
        <hr /><p><a class="backlink button" href="<?=doadminlink("issue_show", array("issueid" => $adminactive['issueid']), true);?>"><?=_("Back");?></a></p>

<?php
    }
}
?>