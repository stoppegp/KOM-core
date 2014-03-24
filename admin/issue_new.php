    <h2><?=_("New issue");?></h2>

<form method="post">

<? include (dirname(__FILE__).'/issue_form.php'); ?>

<input type="hidden" name="do" value="issue_new" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("issue_list", null, true);?>"><?=_("Back");?></a></p>