<?php
$thisissueid = $adminactive['issueid'];
if (!is_numeric($thisissueid) || !$database->getIssue($thisissueid)) {
    redirect(array("page" => "issue_list"), null, "notfound");
}
    $thisissue = $database->getIssue($thisissueid);
    
    if (!isset($oldarray)) {
        $oldarray['name'] = $thisissue->getName();
        $oldarray['desc'] = $thisissue->getDesc();
        $oldarray['comment'] = $thisissue->getComment();
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
    

<hr /><p><a class="backlink button" href="<?=doadminlink("issue_list", null, true);?>"><?=_("Back");?></a></p>