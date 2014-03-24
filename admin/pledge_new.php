<?php
 $thisissueid = $adminactive['issueid'];
 if (!is_numeric($thisissueid) || !($database->getIssue($thisissueid))) {
    redirect(array("page" => "issue_list"), null, "notfound");
 }
 ?>
    <h2><?=_("New Promise");?></h2>

<form method="post">

<?php


 include (dirname(__FILE__).'/pledge_form.php'); ?>

<input type="hidden" name="do" value="pledge_new" />
<input type="hidden" name="pledge[issue_id]" value="<?=$thisissueid;?>" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("issue_show", array("issueid" => $adminactive['issueid']), true);?>"><?=_("Back");?></a></p>