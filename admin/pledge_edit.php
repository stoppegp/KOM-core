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
        
        if (!isset($oldarray)) {
            $oldarray['name'] = $thispledge->getName();
            $oldarray['desc'] = $thispledge->getDesc();
            $oldarray['party'] = $thispledge->getParty()->getID();
            $oldarray['default_pledgestatetype'] = $thispledge->getDefaultPledgestatetype()->getID();
            $oldarray['quoteurl'] = $thispledge->getQuote()->getURL();
            $oldarray['quotetext'] = $thispledge->getQuote()->getText();
            $oldarray['quotepage'] = $thispledge->getQuote()->getPage();
            $oldarray['quotesource'] = $thispledge->getQuote()->getSource();
        }

        ?>

        <h2><?=_("Edit promise");?></h2>
        <h3><?=_("Issue");?> <?=$thisissue->getID();?> – <?=$thisissue->getName();?></h3>
        <h3><?=_("Promise");?> <?=$thispledge->getID();?> – <?=$thispledge->getName();?></h3>
        
        <form method="post">

        <? include ('pledge_form.php'); ?>

        <input type="hidden" name="do" value="pledge_edit" />
        <input type="hidden" name="pledge[issue_id]" value="<?=$thisissueid;?>" />
        <input type="hidden" name="pledge[id]" value="<?=$thispledgeid;?>" />
        </form>
    
<?php
    }
}
?>

<hr /><p><a class="backlink button" href="<?=doadminlink("issue_show");?>"><?=_("Back");?></a></p>