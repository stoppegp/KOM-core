    <h2>Thema hinzufügen</h2>

<form method="post">

<? include ('issue_form.php'); ?>

<input type="hidden" name="do" value="issue_new" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("issue_list");?>">Zurück</a></p>