<?php
$thisuserid = $adminactive['userid'];

$users = $dblink->Select("users", "*", "WHERE `id`=".$thisuserid);

if (!$users[0]) {
    echo "Die User-ID wurde nicht gefunden.";
} else {
    $thisuser = $users[0];
    if (!isset($oldarray)) {
        $oldarray['name'] = $thisuser->name;
        $oldarray['email'] = $thisuser->email;
        $oldarray['username'] = $thisuser->username;
        $oldarray['admin'] = $thisuser->admin;
    }
    ?>

    <h2>Benutzer bearbeiten</h2>
    <h3>Benutzer <?=$thisuser->id;?> – <?=$thisuser->username;?></h3>
    
    <form method="post">

    <? include ('user_form.php'); ?>

    <input type="hidden" name="do" value="user_edit" />
    <input type="hidden" name="user[id]" value="<?=$thisuserid;?>" />
    </form>
    
<?php
}
?>

<hr /><p><a class="backlink button" href="<?=doadminlink("user_list");?>">Zurück</a></p>