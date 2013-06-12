<?php
$thisissueid = $adminactive['issueid'];
$thisstateid = $adminactive['stateid'];

if (!is_numeric($thisissueid) || !($database->getIssue($thisissueid))) {
    redirect(array("page" => "issue_list"), null, "notfound");
}
$thisissue = $database->getIssue($thisissueid);
if (!is_numeric($thisstateid) || !($thisissue->getState($thisstateid))) {
    redirect(array("page" => "issue_show", "issueid" => $thisissueid), null, "notfound");
}
 
$thisstate = $thisissue->getState($thisstateid);
    
        if (!isset($oldarray)) {
            $oldarray['name'] = $thisstate->getName();
            $oldarray['datum'] = date("d.m.Y", $thisstate->getDatum());

            $oldarray['quoteurl'] = $thisstate->getQuote()->getURL();
            $oldarray['quotetext'] = $thisstate->getQuote()->getText();
            $oldarray['quotesource'] = $thisstate->getQuote()->getSource();
            
            if (is_array($thisissue->getPledges())) {
                foreach($thisissue->getPledges() as $value) {
                    if ($thisstate->getPledgestateOfPledge($value->getID())) {
                        $oldarray['pledges'][$value->getID()] = $thisstate->getPledgestateOfPledge($value->getID())->getPledgestatetype()->getID();
                    }
                }
            }
        }
        ?>

        <h2><?=_("Edit state");?></h2>
        <h3><?=_("Issue");?> <?=$thisissue->getID();?> – <?=$thisissue->getName();?></h3>
        <h3><?=_("State");?> <?=$thisstate->getID();?> – <?=$thisstate->getName();?></h3>
        
        <form method="post">

        <? include ('state_form.php'); ?>

        <input type="hidden" name="do" value="state_edit" />
        <input type="hidden" name="state[issue_id]" value="<?=$thisissueid;?>" />
        <input type="hidden" name="state[id]" value="<?=$thisstateid;?>" />
        </form>
    
<hr /><p><a class="backlink button" href="<?=doadminlink("issue_show", array("issueid" => $adminactive['issueid']), true);?>"><?=_("Back");?></a></p>