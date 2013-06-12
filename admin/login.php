
  <form method="post">
  <table><tr><td style="text-align:right;"><?=_("Username");?>:</td><td><input type="text" value="<?=retisset($username);?>" name="username" /></td></tr>
   <tr><td style="text-align:right;"><?=_("Password");?>:</td><td><input type="password" name="passwort" /></td></tr></table>
   <input type="submit" value="<?=_("Login");?>" />
   <input type="hidden" name="login" value="1" />
   <input type="hidden" name="logout" value="false" />
  </form>
