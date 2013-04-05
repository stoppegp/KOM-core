
  <form method="post">
  <table><tr><td style="text-align:right;">Benutzername:</td><td><input type="text" value="<?=$username;?>" name="username" /></td></tr>
   <tr><td style="text-align:right;">Passwort:</td><td><input type="password" name="passwort" /></td></tr></table>
   <input type="submit" value="Anmelden" />
   <input type="hidden" name="login" value="1" />
   <input type="hidden" name="logout" value="false" />
  </form>
