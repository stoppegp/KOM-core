<table class="bordertable">

    <tr>
        <td>
            Name:
        </td>
        <td>
            <input type="text" name="cat[name]" value="<?=$oldarray['name'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            Ausblenden:
        </td>
        <td>
            <input type="checkbox" name="cat[disabled]" value="1" <? echo ($oldarray['disabled']==1) ? "checked=\"checked\"" : ""; ?>" />
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="submit" value="OK" />
        </td>
    </tr>


</table>