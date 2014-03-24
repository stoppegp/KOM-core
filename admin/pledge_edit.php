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

        <? include (dirname(__FILE__).'/pledge_form.php'); ?>

        <input type="hidden" name="do" value="pledge_edit" />
        <input type="hidden" name="pledge[issue_id]" value="<?=$thisissueid;?>" />
        <input type="hidden" name="pledge[id]" value="<?=$thispledgeid;?>" />
        </form>
    

<hr /><p><a class="backlink button" href="<?=doadminlink("issue_show", array("issueid" => $adminactive['issueid']), true);?>"><?=_("Back");?></a></p>