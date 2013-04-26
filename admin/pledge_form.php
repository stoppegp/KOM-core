<table class="bordertable">

    <tr>
        <td>
            <?=_("Party");?>:
        </td>
        <td>
            <select name="pledge[party]">
                <?php
                foreach ($database->getParties("order") as $value) {
                    ?>
                    <option <? echo ($value->getID() == $oldarray['party']) ? "selected=\"selected\"" : "" ?> value="<?=$value->getID();?>"><?=$value->getName();?></option>
                    <?
                }
                
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Pledge");?>:
        </td>
        <td>
            <input type="text" name="pledge[name]" value="<?=$oldarray['name'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Description");?>:
        </td>
        <td>
            <textarea name="pledge[desc]"><?=$oldarray['desc'];?></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Start info");?>:
        </td>
        <td>
            <select name="pledge[default_pledgestatetype]">
                <optgroup label="Forderung">
                <?php
                    foreach ($database->getPledgestatetypes("order") as $value) {
                        if ($value->getType() == 0) {
                        ?>
                            <option <? echo ($value->getID() == $oldarray['default_pledgestatetype']) ? "selected=\"selected\"" : "" ?> value="<?=$value->getID();?>"><?=$value->getName();?></option>
                        <?
                        }
                    }
                ?>
                </optgroup>
                <optgroup label="Zustand">
                <?php
                    foreach ($database->getPledgestatetypes("order") as $value) {
                        if ($value->getType() == 1) {
                        ?>
                            <option <? echo ($value->getID() == $oldarray['default_pledgestatetype']) ? "selected=\"selected\"" : "" ?> value="<?=$value->getID();?>"><?=$value->getName();?></option>
                        <?
                        }
                    }
                ?>
                </optgroup>
            </select>
        </td>
    </tr>
</table>
<h4><?=_("Source");?></h4>
<table class="bordertable">
    <tr>
        <tr><td><?=_("Quote");?>:</td>
        <td><textarea name="pledge[quotetext]"><?=$oldarray['quotetext'];?></textarea></td></tr>
        <tr><td><?=_("Source");?>:</td>
        <td><input type="text" name="pledge[quotesource]" value="<?=$oldarray['quotesource'];?>" /></td></tr>
        <tr><td><?=_("URL");?>:</td>
         <td><input type="text" name="pledge[quoteurl]" value="<?=$oldarray['quoteurl'];?>" /></td></tr>
        <tr><td><?=_("Page in the electoral platform");?>:</td>
        <td><input style="width: 50px;" type="text" name="pledge[quotepage]" value="<?=$oldarray['quotepage'];?>" /><br><small><?=_("If filled, the fields source and URL are ignored.");?></small></td></tr>
</table>

            <p><input type="submit" value="OK" /></p>
