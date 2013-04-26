    <h2>Partei hinzufügen</h2>

<form method="post">

<?php
    if (!isset($oldarray['programme_name'])) $oldarray['programme_name'] = "Wahlprogramm";

?>

<? include ('party_form.php'); ?>

<input type="hidden" name="do" value="party_new" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("party_list");?>">Zurück</a></p>