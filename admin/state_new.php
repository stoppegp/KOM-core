    <h2><?=_("New state");?></h2>

<form method="post">

<?php
 $thisissueid = $adminactive['issueid'];
 $thisissue = &$database->getIssue($thisissueid);

 include ('state_form.php'); ?>

<input type="hidden" name="do" value="state_new" />
<input type="hidden" name="state[issue_id]" value="<?=$thisissueid;?>" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("issue_show", array("issueid" => $adminactive['issueid']), true);?>"><?=_("Back");?></a></p>