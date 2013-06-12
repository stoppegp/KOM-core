<?php
$thisuserid = $adminactive['userid'];

$users = $dblink->Select("users", "*", "WHERE `id`=".(int)$thisuserid);

if (!isset($users[0])) {
    redirect(array("page" => "user_list"), null, "notfound");
}
    $thisuser = $users[0];
    if (!isset($oldarray)) {
        $oldarray['name'] = $thisuser->name;
        $oldarray['email'] = $thisuser->email;
        $oldarray['username'] = $thisuser->username;
        $oldarray['admin'] = $thisuser->admin;
    }
    ?>

    <h2><?=_("Edit user");?></h2>
    <h3><?=_("User");?> <?=$thisuser->id;?> – <?=$thisuser->username;?></h3>
    
    <form method="post">

    <? include ('user_form.php'); ?>

    <input type="hidden" name="do" value="user_edit" />
    <input type="hidden" name="user[id]" value="<?=$thisuserid;?>" />
    </form>

<hr /><p><a class="backlink button" href="<?=doadminlink("user_list", null, true);?>"><?=_("Back");?></a></p>