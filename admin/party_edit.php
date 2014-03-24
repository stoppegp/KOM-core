<?php
$thispartyid = $adminactive['partyid'];

$parties = $dblink->Select("parties", "*", "WHERE `id`=".(int)$thispartyid);

if (!isset($parties[0])) {
     redirect(array("page" => "party_list"), null, "notfound");
}

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

    <h2><?=_("Edit Party");?></h2>
    <h3><?=_("Party");?> <?=$thisparty->id;?> – <?=$thisparty->name;?></h3>
    
    <form method="post">

    <? include (dirname(__FILE__).'/party_form.php'); ?>

    <input type="hidden" name="do" value="party_edit" />
    <input type="hidden" name="party[id]" value="<?=$thispartyid;?>" />
    </form>

<hr /><p><a class="backlink button" href="<?=doadminlink("party_list", null, true);?>"><?=_("Back");?></a></p>