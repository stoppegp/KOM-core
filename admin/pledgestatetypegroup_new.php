    <h2><?=_("New Group");?></h2>

<form method="post">

<? include (dirname(__FILE__).'/pledgestatetypegroup_form.php'); ?>

<input type="hidden" name="do" value="pledgestatetypegroup_new" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("pledgestatetype_list", null, true);?>"><?=_("Back");?></a></p>