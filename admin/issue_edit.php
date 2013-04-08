<?php
$thisissueid = $adminactive['issueid'];
if (!$database->getIssue($thisissueid)) {
    echo "Die Issue-ID wurde nicht gefunden.";
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

    <h2>Thema bearbeiten</h2>
    <h3>Thema <?=$thisissue->getID();?> – <?=$thisissue->getName();?></h3>
    
    <form method="post">

    <? include ('issue_form.php'); ?>

    <input type="hidden" name="do" value="issue_edit" />
    <input type="hidden" name="issue[id]" value="<?=$thisissueid;?>" />
    </form>
    
<?php
}
?>

<hr /><p><a class="backlink button" href="<?=doadminlink("issue_list");?>">Zurück</a></p>