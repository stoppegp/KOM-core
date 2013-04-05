<?php
$thisissueid = $adminactive['issueid'];
$thisstateid = $adminactive['stateid'];
if (!$database->getIssue($thisissueid)) {
    echo "Die Issue-ID wurde nicht gefunden.";
} else {
    $thisissue = &$database->getIssue($thisissueid);
    
    if (!$thisissue->getState($thisstateid)) {
        echo "Die State-ID wurde nicht gefunden.";
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
                        $oldarray['pledges'][$value->getID()] = $thisstate->getPledgestateOfPledge($value->getID())->getPledgestatetypeLink()->getID();
                    }
                }
            }
        }
        ?>

        <h2>Versprechen bearbeiten</h2>
        <h3>Thema <?=$thisissue->getID();?> – <?=$thisissue->getName();?></h3>
        <h3>Thema <?=$thisstate->getID();?> – <?=$thisstate->getName();?></h3>
        
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

<hr /><p><a class="backlink button" href="<?=doadminlink("issue_show");?>">Zurück</a></p>