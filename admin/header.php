<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <title>KOM</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/layout.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
  </head>
  <body>
  <div class="main">
  <?php
  if (!(!isset($_SESSION['login']) || !$_SESSION['login'])) {
  ?>
    <div class="user">
  Angemeldet als<br><strong>
    <?php
    echo $_SESSION['user'];
    ?></strong><br><a href="<?=doadminlink("", array("logout" => "true"));?>">(Logout)</a>
  </div>
  <?php } ?>
    <div class="header">
    <h1>Kretschmann-O-Meter Admin</h1>
    <hr />
    <?php if (isset($_SESSION['login'])) { ?>
    
    <ul class="menu">
    <li><a <? echo (in_array($adminactive['page'], array("issue_list", "issue_new", "issue_edit", "issue_del", "issue_show", "pledge_new", "pledge_del", "pledge_edit", "state_new", "state_del", "state_edit"))) ? "id=\"active_main\"" : ""; ?>  href="<?=doadminlink("issue_list");?>">Inhalt</a></li>
    <?php
    if ($_SESSION['admin'] == 1) {
    ?>
        <li><a <? echo (in_array($adminactive['page'], array("cat_list", "cat_del", "cat_edit"))) ? "id=\"active_main\"" : ""; ?>  href="<?=doadminlink("cat_list");?>">Kategorien</a></li>
        <li><a <? echo (in_array($adminactive['page'], array("user_list", "user_new", "user_edit", "user_del"))) ? "id=\"active_main\"" : ""; ?>  href="<?=doadminlink("user_list");?>">Benutzer</a></li>
    <?php } ?>
    </ul>
    <?php } ?>
    </div>
    <div class="content contentwide">