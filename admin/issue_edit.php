<?php
$thisissueid = $adminactive['issueid'];
if (!$database->getIssue($thisissueid)) {
    echo _("Issue-ID not found.");
} else {
    $thisissue = &$database->getIssue($thisissueid);
    
    if (!isset($oldarray)) {
        $oldarray['name'] = $thisissue->getName();
        $oldarray['desc'] = $thisissue->getDesc();
        foreach ($thisissue->getCategories() as $value) {
            $oldarray['cat'][$value->getID()] = 1;
        }
    }

    ?>

    <h2><?=_("Edit issue");?></h2>
    <h3><?=_("Issue");?> <?=$thisissue->getID();?> – <?=$thisissue->getName();?></h3>
    
    <form method="post">

    <? include ('issue_form.php'); ?>

    <input type="hidden" name="do" value="issue_edit" />
    <input type="hidden" name="issue[id]" value="<?=$thisissueid;?>" />
    </form>
    
<?php
}
?>

<hr /><p><a class="backlink button" href="<?=doadminlink("issue_list");?>"><?=_("Back");?></a></p>