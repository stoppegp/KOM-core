    <h2>Benutzer hinzufügen</h2>

<form method="post">

<? include ('user_form.php'); ?>

<input type="hidden" name="do" value="user_new" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("user_list");?>">Zurück</a></p>