<?php
$thispledgestatetypeid = $adminactive['pledgestatetypeid'];

$pledgestatetypes = $dblink->Select("pledgestatetypes", "*", "WHERE `id`=".$thispledgestatetypeid);

if (!$pledgestatetypes[0]) {
    echo "Die Bewertungs-ID wurde nicht gefunden.";
} else {
    $thispledgestatetype = $pledgestatetypes[0];
    if (!isset($oldarray)) {
        $oldarray['name'] = $thispledgestatetype->name;
        $oldarray['colour'] = $thispledgestatetype->colour;
        $oldarray['colour2'] = $thispledgestatetype->colour2;
        $oldarray['value'] = $thispledgestatetype->value;
        $oldarray['multipl'] = $thispledgestatetype->multipl;
        $oldarray['type'] = $thispledgestatetype->type;
        $oldarray['order'] = $thispledgestatetype->order;
    }
    ?>

    <h2>Bewertung bearbeiten</h2>
    <h3>Bewertung <?=$thispledgestatetype->id;?> – <?=$thispledgestatetype->name;?></h3>
    
    <form method="post">

    <? $hidetype = true;
    include ('pledgestatetype_form.php'); ?>

    <input type="hidden" name="do" value="pledgestatetype_edit" />
    <input type="hidden" name="pledgestatetype[id]" value="<?=$thispledgestatetypeid;?>" />
    </form>
    
<?php
}
?>

<hr /><p><a class="backlink button" href="<?=doadminlink("pledgestatetype_list");?>">Zurück</a></p>