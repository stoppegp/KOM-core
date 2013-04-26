<table class="bordertable">

    <tr>
        <td>
            Bezeichnung:
        </td>
        <td>
            <input type="text" name="pledgestatetype[name]" value="<?=$oldarray['name'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            Punkte:
        </td>
        <td>
            <input type="text" name="pledgestatetype[value]" value="<?=$oldarray['value'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            In die Wertung aufnehmen:
        </td>
        <td>
            <input type="checkbox" name="pledgestatetype[multipl]" value="1" <? echo ($oldarray['multipl']==1) ? "checked=\"checked\"" : ""; ?> />
        </td>
    </tr>
    <?php
    if (!$hidetype) { ?>
    <tr>
        <td>
            Typ:
        </td>
        <td>
            <input type="radio" name="pledgestatetype[type]" value="0" <? echo ($oldarray['type']!=1) ? "checked=\"checked\"" : ""; ?> /> Forderung<br>
            <input type="radio" name="pledgestatetype[type]" value="1" <? echo ($oldarray['type']==1) ? "checked=\"checked\"" : ""; ?> /> Zustand
        </td>
    </tr>
    <? } ?>
    <tr>
        <td>
            Reihenfolge:
        </td>
        <td>
            <input type="text" name="pledgestatetype[order]" value="<?=$oldarray['order'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            Farbe:
        </td>
        <td>
            <input type="text" name="pledgestatetype[colour]" value="<?=$oldarray['colour'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            Farbe 2:
        </td>
        <td>
            <input type="text" name="pledgestatetype[colour2]" value="<?=$oldarray['colour2'];?>" />
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="submit" value="OK" />
        </td>
    </tr>


</table>