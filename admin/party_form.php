<table class="bordertable">

    <tr>
        <td>
            Name:
        </td>
        <td>
            <input type="text" name="party[name]" value="<?=$oldarray['name'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            Kürzel:
        </td>
        <td>
            <input type="text" name="party[acronym]" value="<?=$oldarray['acronym'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            Programm-URL:
        </td>
        <td>
            <input type="text" name="party[programme_url]" value="<?=$oldarray['programme_url'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            Programm-Offset:
        </td>
        <td>
            <input type="text" name="party[programme_offset]" value="<?=$oldarray['programme_offset'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            Programm-Name:
        </td>
        <td>
            <input type="text" name="party[programme_name]" value="<?=$oldarray['programme_name'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            Farbe:
        </td>
        <td>
            <input type="text" name="party[colour]" value="<?=$oldarray['colour'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            Reihenfolge:
        </td>
        <td>
            <input type="text" name="party[order]" value="<?=$oldarray['order'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            In die Wertung aufnehmen:
        </td>
        <td>
            <input type="checkbox" name="party[doValue]]" value="1" <? echo ($oldarray['doValue']==1) ? "checked=\"checked\"" : ""; ?> />
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="submit" value="OK" />
        </td>
    </tr>


</table>