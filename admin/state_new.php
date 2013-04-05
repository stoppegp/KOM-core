    <h2>Status hinzufügen</h2>

<form method="post">

<?php
 $thisissueid = $adminactive['issueid'];
 $thisissue = &$database->getIssue($thisissueid);

 include ('state_form.php'); ?>

<input type="hidden" name="do" value="state_new" />
<input type="hidden" name="state[issue_id]" value="<?=$thisissueid;?>" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("issue_show");?>">Zurück</a></p>