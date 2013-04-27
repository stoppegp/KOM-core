<table class="bordertable">

    <tr>
        <td>
            <?=_("Label");?>:
        </td>
        <td>
            <input type="text" name="pledgestatetypegroup[name]" value="<?=$oldarray['name'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Order");?>:
        </td>
        <td>
            <input type="text" name="pledgestatetypegroup[order]" value="<?=$oldarray['order'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Colour");?>:
        </td>
        <td>
            <input type="text" name="pledgestatetypegroup[colour]" value="<?=$oldarray['colour'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Ratings");?>:
        </td>
        <td>
            <?php
                $pledgestatetypes = $dblink->Select("pledgestatetypes");
                if (is_array($pledgestatetypes)) {
                    foreach ($pledgestatetypes as $value) {
                        echo '<input type="checkbox" name="pledgestatetypegroup[pledgestatetype_ids]['.$value->id.']" '.(($oldarray['pledgestatetype_ids'][$value->id] == 1) ? "checked=\"checked\"": "").' value="1" /> #'.$value->id.": ".$value->name."<br>";
                    }
                }
            
            ?>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="submit" value="OK" />
        </td>
    </tr>


</table>