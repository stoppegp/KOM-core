<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <title><?=KOM::$pagetitle;?> <?=_("ADMIN");?></title>
    <link rel="stylesheet" type="text/css" href="admin.css">
  </head>
  <body>
  <div class="main">
  <?php
  if (!(!isset($_SESSION['login']) || !$_SESSION['login'])) {
  ?>
    <div class="user">
  <?=_("logged in as");?><br><strong>
    <?php
    echo $_SESSION['user'];
    ?></strong><br><a href="<?=doadminlink("", array("logout" => "true"));?>">(<?=_("logout");?>)</a>
  </div>
  <?php } ?>
    <div class="header">
    <h1><?=KOM::$pagetitle;?> <?=_("ADMIN");?></h1>
    <hr />
    <?php if (isset($_SESSION['login'])) { ?>
    
    <ul class="menu">
    <li><a <? echo (in_array($adminactive['page'], array("issue_list", "issue_new", "issue_edit", "issue_del", "issue_show", "pledge_new", "pledge_del", "pledge_edit", "state_new", "state_del", "state_edit"))) ? "id=\"active_main\"" : ""; ?>  href="<?=doadminlink("issue_list", null, true);?>"><?=_("Content");?></a></li>
    <li><a <? echo (in_array($adminactive['page'], array("custompages_list", "custompages_edit", "custompages_del", "custompages_new"))) ? "id=\"active_main\"" : ""; ?>  href="<?=doadminlink("custompages_list", null, true);?>"><?=_("Pages");?></a></li>
    <?php
    if ($_SESSION['admin'] == 1) {
    ?>
        <li><a <? echo (in_array($adminactive['page'], array("cat_list", "cat_new", "cat_del", "cat_edit"))) ? "id=\"active_main\"" : ""; ?>  href="<?=doadminlink("cat_list", null, true);?>"><?=_("Categories");?></a></li>
        <li><a <? echo (in_array($adminactive['page'], array("party_list", "party_new", "party_del", "party_edit"))) ? "id=\"active_main\"" : ""; ?>  href="<?=doadminlink("party_list", null, true);?>"><?=_("Parties");?></a></li>
        <li><a <? echo (in_array($adminactive['page'], array("pledgestatetype_list", "pledgestatetype_new", "pledgestatetype_del", "pledgestatetype_edit"))) ? "id=\"active_main\"" : ""; ?>  href="<?=doadminlink("pledgestatetype_list", null, true);?>"><?=_("Ratings");?></a></li>
        <li><a <? echo (in_array($adminactive['page'], array("user_list", "user_new", "user_edit", "user_del"))) ? "id=\"active_main\"" : ""; ?>  href="<?=doadminlink("user_list", null, true);?>"><?=_("Users");?></a></li>
    <?php } ?>
    </ul>
    <?php } ?>
    </div>
    <div class="content contentwide">