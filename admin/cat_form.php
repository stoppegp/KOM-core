<table class="bordertable">

    <tr>
        <td>
            <?=_("Label:");?>
        </td>
        <td>
            <input type="text" name="cat[name]" value="<?=retisset($oldarray['name']);?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Do not display:");?>
        </td>
        <td>
            <input type="checkbox" name="cat[disabled]" value="1" <? echo (isset($oldarray['disabled']) && ($oldarray['disabled']==1)) ? "checked=\"checked\"" : ""; ?>" />
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="submit" value="<?=_("OK");?>" />
        </td>
    </tr>


</table>