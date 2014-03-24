    <h2><?=_("New page");?></h2>

<form method="post">

<? include (dirname(__FILE__).'/custompages_form.php'); ?>

<input type="hidden" name="do" value="custompages_new" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("custompages_list", null, true);?>"><?=_("Back");?></a></p>