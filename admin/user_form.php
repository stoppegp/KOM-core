<table class="bordertable">

    <tr>
        <td>
            Benutzername:
        </td>
        <td>
            <input type="text" name="user[username]" value="<?=$oldarray['username'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            Name:
        </td>
        <td>
            <input type="text" name="user[name]" value="<?=$oldarray['name'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            E-Mail:
        </td>
        <td>
            <input type="text" name="user[email]" value="<?=$oldarray['email'];?>" /><br><small>Wenn angegeben, bekommt der Benutzer Benachrichtigungen per E-Mail</small>
        </td>
    </tr>
    <tr>
        <td>
            Administrator:
        </td>
        <td>
            <input type="checkbox" name="user[admin]" value="1" <? echo ($oldarray['admin']==1) ? "checked=\"checked\"" : ""; ?> />
        </td>
    </tr>
    <tr>
        <td>
            Kennwort:
        </td>
        <td>
            <input type="password" name="user[password]" value="" />
        </td>
    </tr>
    <tr>
        <td>
            Kennwort bestätigen:
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