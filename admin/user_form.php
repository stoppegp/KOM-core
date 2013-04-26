<table class="bordertable">

    <tr>
        <td>
            <?=_("Username");?>:
        </td>
        <td>
            <input type="text" name="user[username]" value="<?=$oldarray['username'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Name");?>:
        </td>
        <td>
            <input type="text" name="user[name]" value="<?=$oldarray['name'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("E-Mail");?>:
        </td>
        <td>
            <input type="text" name="user[email]" value="<?=$oldarray['email'];?>" /><br><small>Wenn angegeben, bekommt der Benutzer Benachrichtigungen per E-Mail</small>
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Administrator");?>:
        </td>
        <td>
            <input type="checkbox" name="user[admin]" value="1" <? echo ($oldarray['admin']==1) ? "checked=\"checked\"" : ""; ?> />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Password");?>:
        </td>
        <td>
            <input type="password" name="user[password]" value="" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Confirm password");?>:
        </td>
        <td>
            <input type="password" name="user[password2]" value="" />
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="submit" value="OK" />
        </td>
    </tr>


</table>