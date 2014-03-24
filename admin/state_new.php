<?php
 $thisissueid = $adminactive['issueid'];
 if (!is_numeric($thisissueid) || !($database->getIssue($thisissueid))) {
    redirect(array("page" => "issue_list"), null, "notfound");
 }
 $thisissue = $database->getIssue($thisissueid);
 ?>

    <h2><?=_("New state");?></h2>

<form method="post">

<?php
 include (dirname(__FILE__).'/state_form.php'); ?>

<input type="hidden" name="do" value="state_new" />
<input type="hidden" name="state[issue_id]" value="<?=$thisissueid;?>" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("issue_show", array("issueid" => $adminactive['issueid']), true);?>"><?=_("Back");?></a></p>