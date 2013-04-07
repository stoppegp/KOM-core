<?php
$thiscustompageid = $adminactive['custompageid'];

$custompages = $dblink->Select("custompages", "*", "WHERE `id`=".$thiscustompageid);

if (!$custompages[0]) {
    echo "Die Page-ID wurde nicht gefunden.";
} else {
    $thiscustompage = $custompages[0];
    if (!isset($oldarray)) {
        $oldarray['name'] = $thiscustompage->name;;
        $oldarray['content'] = $thiscustompage->content;
    }
    ?>

    <h2>Seite bearbeiten</h2>
    <h3>Seite <?=$thiscustompage->id;?> – <?=$thiscustompage->name;?></h3>
    
    <form method="post">

    <? include ('custompages_form.php'); ?>

    <input type="hidden" name="do" value="custompages_edit" />
    <input type="hidden" name="custompages[id]" value="<?=$thiscustompageid;?>" />
    </form>
    
<?php
}
?>

<hr /><p><a class="backlink button" href="<?=doadminlink("custompages_list");?>">Zurück</a></p>