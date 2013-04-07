<?php
$thiscatid = $adminactive['catid'];
if (!$database->getCategory($thiscatid)) {
    echo "Die Cat-ID wurde nicht gefunden.";
} else {
    $thiscat = &$database->getCategory($thiscatid);
    
    if (!isset($oldarray)) {
        $oldarray['name'] = $thiscat->getName();
        $oldarray['disabled'] = $thiscat->getDisabled();
    }


    ?>

    <h2>Karegorie bearbeiten</h2>
    <h3>Kategorie <?=$thiscat->getID();?> – <?=$thiscat->getName();?></h3>
    
    <form method="post">

    <? include ('cat_form.php'); ?>

    <input type="hidden" name="do" value="cat_edit" />
    <input type="hidden" name="cat[id]" value="<?=$thiscatid;?>" />
    </form>
    
<?php
}
?>

<hr /><p><a class="backlink button" href="<?=doadminlink("cat_list");?>">Zurück</a></p>