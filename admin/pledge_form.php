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
                    <option <? echo ((isset($oldarray['party'])) && ($value->getID() == $oldarray['party'])) ? "selected=\"selected\"" : "" ?> value="<?=$value->getID();?>"><?=$value->getName();?></option>
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
            <input type="text" name="pledge[name]" value="<?=retisset($oldarray['name']);?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Description");?>:
        </td>
        <td>
            <textarea name="pledge[desc]"><?=retisset($oldarray['desc']);?></textarea>
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
                            <option <? echo (isset($oldarray['default_pledgestatetype']) && ($value->getID() == $oldarray['default_pledgestatetype'])) ? "selected=\"selected\"" : "" ?> value="<?=$value->getID();?>"><?=$value->getName();?></option>
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
                            <option <? echo (isset($oldarray['default_pledgestatetype']) && ($value->getID() == $oldarray['default_pledgestatetype'])) ? "selected=\"selected\"" : "" ?> value="<?=$value->getID();?>"><?=$value->getName();?></option>
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
        <td><textarea name="pledge[quotetext]"><?=retisset($oldarray['quotetext']);?></textarea></td></tr>
        <tr><td><?=_("Source");?>:</td>
        <td><input type="text" name="pledge[quotesource]" value="<?=retisset($oldarray['quotesource']);?>" /></td></tr>
        <tr><td><?=_("URL");?>:</td>
         <td><input type="text" name="pledge[quoteurl]" value="<?=retisset($oldarray['quoteurl']);?>" /></td></tr>
        <tr><td><?=_("Page in the electoral platform");?>:</td>
        <td><input style="width: 50px;" type="text" name="pledge[quotepage]" value="<?=retisset($oldarray['quotepage']);?>" /><br><small><?=_("If filled, the fields source and URL are ignored.");?></small></td></tr>
</table>

            <p><input type="submit" value="OK" /></p>
