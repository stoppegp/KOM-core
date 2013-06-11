<?php

$thisuserid = $adminactive['userid'];
$users = $dblink->Select("users", "*", "WHERE `id`=".$thisuserid);

if (!$users[0]) {
    echo _("User-ID not found.");
} else {
    $thisuser = $users[0];

?>
    <h2><?=_("Delete user");?></h2>
    <h3><?=_("User");?> <?=$thisuser->id;?> – <?=$thisuser->username;?></h3>
<form method="post">

<p style="color:red;"><?=_("Do you really want to delete this entry? This operation can't be undone!");?></p>

<input type="submit" name="submit_del" value="<?=_("Yes, delete!");?>" />
<input type="submit" value="<?=_("No");?>" />

<input type="hidden" name="do" value="user_del" />
<input type="hidden" name="user[id]" value="<?=$thisuserid;?>" />
</form>
<hr /><p><a class="backlink button" href="<?=doadminlink("user_list", null, true);?>"><?=_("Back");?></a></p>

<?php

}

?>