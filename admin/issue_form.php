<table class="bordertable">

    <tr>
        <td>
            <?=_("Issue");?>:
        </td>
        <td>
            <input type="text" name="issue[name]" value="<?=retisset($oldarray['name']);?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Description");?>:
        </td>
        <td>
            <textarea name="issue[desc]"><?=retisset($oldarray['desc']);?></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Category");?>:
        </td>
        <td>
            <?php
                foreach ($database->getCategories("name") as $value) {
                    ?>
                        <input <? echo (isset($oldarray['cat']) && (is_array($oldarray['cat'])) && (in_array($value->getID(), array_keys($oldarray['cat'])))) ? "checked=\"checked\"": ""; ?> type="checkbox" name="issue[cat][<?=$value->getID();?>]" value="1" /> <?=$value->getName();?><br>
                    <?
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