<?php
$thispartyid = $adminactive['partyid'];

$parties = $dblink->Select("parties", "*", "WHERE `id`=".$thispartyid);

if (!$parties[0]) {
    echo "Die Partei-ID wurde nicht gefunden.";
} else {
    $thisparty = $parties[0];
    if (!isset($oldarray)) {
        $oldarray['name'] = $thisparty->name;
        $oldarray['acronym'] = $thisparty->acronym;
        $oldarray['colour'] = $thisparty->colour;
        $oldarray['programme_url'] = $thisparty->programme_url;
        $oldarray['programme_name'] = $thisparty->programme_name;
        $oldarray['programme_offset'] = $thisparty->programme_offset;
        $oldarray['doValue'] = $thisparty->doValue;
        $oldarray['order'] = $thisparty->order;
    }
    ?>

    <h2>Partei bearbeiten</h2>
    <h3>Partei <?=$thisparty->id;?> – <?=$thisparty->name;?></h3>
    
    <form method="post">

    <? include ('party_form.php'); ?>

    <input type="hidden" name="do" value="party_edit" />
    <input type="hidden" name="party[id]" value="<?=$thispartyid;?>" />
    </form>
    
<?php
}
?>

<hr /><p><a class="backlink button" href="<?=doadminlink("party_list");?>">Zurück</a></p>