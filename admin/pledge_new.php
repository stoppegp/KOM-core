    <h2>Versprechen hinzufügen</h2>

<form method="post">

<?php
 $thisissueid = $adminactive['issueid'];

 include ('pledge_form.php'); ?>

<input type="hidden" name="do" value="pledge_new" />
<input type="hidden" name="pledge[issue_id]" value="<?=$thisissueid;?>" />
</form>

<hr /><p><a class="backlink button" href="<?=doadminlink("issue_show");?>">Zurück</a></p>