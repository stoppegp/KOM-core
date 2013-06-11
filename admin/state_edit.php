<?php
$thisissueid = $adminactive['issueid'];
$thisstateid = $adminactive['stateid'];
if (!$database->getIssue($thisissueid)) {
    echo _("Issue-ID not found.");
} else {
    $thisissue = $database->getIssue($thisissueid);
    
    if (!$thisissue->getState($thisstateid)) {
        echo _("State-ID not found.");
    } else {
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
    
<?php
    }
}
?>

<hr /><p><a class="backlink button" href="<?=doadminlink("issue_show", array("issueid" => $adminactive['issueid']), true);?>"><?=_("Back");?></a></p>