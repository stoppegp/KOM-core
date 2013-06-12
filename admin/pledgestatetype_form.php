<table class="bordertable">

    <tr>
        <td>
            <?=_("Label");?>:
        </td>
        <td>
            <input type="text" name="pledgestatetype[name]" value="<?=retisset($oldarray['name']);?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Points");?>:
        </td>
        <td>
            <input type="text" name="pledgestatetype[value]" value="<?=retisset($oldarray['value']);?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Include into valuation");?>:
        </td>
        <td>
            <input type="checkbox" name="pledgestatetype[multipl]" value="1" <? echo (isset($oldarray['multipl']) && ($oldarray['multipl']==1)) ? "checked=\"checked\"" : ""; ?> />
        </td>
    </tr>
    <?php
    if (!$hidetype) { ?>
    <tr>
        <td>
            <?=_("Type");?>:
        </td>
        <td>
            <input type="radio" name="pledgestatetype[type]" value="0" <? echo (isset($oldarray['type']) && ($oldarray['type']!=1)) ? "checked=\"checked\"" : ""; ?> /> <?=_("Request");?><br>
            <input type="radio" name="pledgestatetype[type]" value="1" <? echo (isset($oldarray['type']) && ($oldarray['type']==1)) ? "checked=\"checked\"" : ""; ?> /> <?=_("Status quo");?>
        </td>
    </tr>
    <? } ?>
    <tr>
        <td>
            <?=_("Order");?>:
        </td>
        <td>
            <input type="text" name="pledgestatetype[order]" value="<?=retisset($oldarray['order']);?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Colour");?>:
        </td>
        <td>
            <input type="text" name="pledgestatetype[colour]" value="<?=retisset($oldarray['colour']);?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Colour");?> 2:
        </td>
        <td>
            <input type="text" name="pledgestatetype[colour2]" value="<?=retisset($oldarray['colour2']);?>" />
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="submit" value="OK" />
        </td>
    </tr>


</table>