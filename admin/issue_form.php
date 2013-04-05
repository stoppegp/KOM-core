<table class="bordertable">

    <tr>
        <td>
            Thema:
        </td>
        <td>
            <input type="text" name="issue[name]" value="<?=$oldarray['name'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            Beschreibung:
        </td>
        <td>
            <textarea name="issue[desc]"><?=$oldarray['desc'];?></textarea>
        </td>
    </tr>
    <tr>
        <td>
            Kategorie:
        </td>
        <td>
            <?php
                foreach ($database->getCategories("name") as $value) {
                    ?>
                        <input <? echo (in_array($value->getID(), array_keys($oldarray['cat']))) ? "checked=\"checked\"": ""; ?> type="checkbox" name="issue[cat][<?=$value->getID();?>]" value="1" /> <?=$value->getName();?><br>
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