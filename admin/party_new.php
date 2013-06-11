    <h2><?=_("New party");?></h2>

<form method="post">

<?php
    if (!isset($oldarray['programme_name'])) $oldarray['programme_name'] = _("Electorial platform");

?>

<? include ('party_form.php'); ?>

<input type="hidden" name="do" value="party_new" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("party_list", null, true);?>"><?=_("Back");?></a></p>