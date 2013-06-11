    <h2><?=_("New Rating");?></h2>

<form method="post">

<? include ('pledgestatetype_form.php'); ?>

<input type="hidden" name="do" value="pledgestatetype_new" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("pledgestatetype_list", null, true);?>"><?=_("Back");?></a></p>