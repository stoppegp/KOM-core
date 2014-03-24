    <h2><?=_("New user");?></h2>

<form method="post">

<? include (dirname(__FILE__).'/user_form.php'); ?>

<input type="hidden" name="do" value="user_new" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("user_list", null, true);?>"><?=_("Back");?></a></p>