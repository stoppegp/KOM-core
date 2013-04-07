    <h2>Seite hinzufügen</h2>

<form method="post">

<? include ('custompages_form.php'); ?>

<input type="hidden" name="do" value="custompages_new" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("custompages_list");?>">Zurück</a></p>