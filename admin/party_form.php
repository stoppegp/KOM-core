<table class="bordertable">

    <tr>
        <td>
            <?=_("Name");?>:
        </td>
        <td>
            <input type="text" name="party[name]" value="<?=retisset($oldarray['name']);?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Acronym");?>:
        </td>
        <td>
            <input type="text" name="party[acronym]" value="<?=retisset($oldarray['acronym']);?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Programme URL");?>
        </td>
        <td>
            <input type="text" name="party[programme_url]" value="<?=retisset($oldarray['programme_url']);?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Programme offset");?>
        </td>
        <td>
            <input type="text" name="party[programme_offset]" value="<?=retisset($oldarray['programme_offset']);?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Programm name");?>
        </td>
        <td>
            <input type="text" name="party[programme_name]" value="<?=retisset($oldarray['programme_name']);?>" />
        </td>
    </tr>
    <tr>
        <td>
            Farbe:
        </td>
        <td>
            <input type="text" name="party[colour]" value="<?=retisset($oldarray['colour']);?>" />
        </td>
    </tr>
    <tr>
        <td>
            Reihenfolge:
        </td>
        <td>
            <input type="text" name="party[order]" value="<?=retisset($oldarray['order']);?>" />
        </td>
    </tr>
    <tr>
        <td>
            In die Wertung aufnehmen:
        </td>
        <td>
            <input type="checkbox" name="party[doValue]]" value="1" <? echo (isset($oldarray['doValue']) && ($oldarray['doValue']==1)) ? "checked=\"checked\"" : ""; ?> />
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="submit" value="OK" />
        </td>
    </tr>


</table>