    <h2><?=_("New Group");?></h2>

<form method="post">

<? include ('pledgestatetypegroup_form.php'); ?>

<input type="hidden" name="do" value="pledgestatetypegroup_new" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("pledgestatetype_list");?>"><?=_("Back");?></a></p>