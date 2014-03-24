    <h2><?=_("New catgegory");?></h2>

<form method="post">

<? include (dirname(__FILE__).'/cat_form.php'); ?>

<input type="hidden" name="do" value="cat_new" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("cat_list", null, true);?>"><?=_("Back");?></a></p>