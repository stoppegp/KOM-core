<?php
$thisissueid = $adminactive['issueid'];
$thispledgeid = $adminactive['pledgeid'];
if (!$database->getIssue($thisissueid)) {
    echo "Die Issue-ID wurde nicht gefunden.";
} else {
    $thisissue = &$database->getIssue($thisissueid);
    
    if (!$thisissue->getPledge($thispledgeid)) {
        echo "Die Pledge-ID wurde nicht gefunden.";
    } else {
        $thispledge = $thisissue->getPledge($thispledgeid);
        
        if (!isset($oldarray)) {
            $oldarray['name'] = $thispledge->getName();
            $oldarray['desc'] = $thispledge->getDesc();
            $oldarray['party'] = $thispledge->getParty()->getID();
            $oldarray['default_pledgestatetype'] = $thispledge->getDefaultPledgestatetypeLink()->getID();
            $oldarray['quoteurl'] = $thispledge->getQuote()->getURL();
            $oldarray['quotetext'] = $thispledge->getQuote()->getText();
            $oldarray['quotepage'] = $thispledge->getQuote()->getPage();
            $oldarray['quotesource'] = $thispledge->getQuote()->getSource();
        }

        ?>

        <h2>Versprechen bearbeiten</h2>
        <h3>Thema <?=$thisissue->getID();?> – <?=$thisissue->getName();?></h3>
        <h3>Thema <?=$thispledge->getID();?> – <?=$thispledge->getName();?></h3>
        
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

<hr /><p><a class="backlink button" href="<?=doadminlink("issue_show");?>">Zurück</a></p>