<table class="bordertable">

    <tr>
        <td>
            Partei:
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
            Versprechen:
        </td>
        <td>
            <input type="text" name="pledge[name]" value="<?=$oldarray['name'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            Beschreibung:
        </td>
        <td>
            <textarea name="pledge[desc]"><?=$oldarray['desc'];?></textarea>
        </td>
    </tr>
    <tr>
        <td>
            Startinfo:
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
<h4>Quelle</h4>
<table class="bordertable">
    <tr>
        <tr><td>Zitat:</td>
        <td><textarea name="pledge[quotetext]"><?=$oldarray['quotetext'];?></textarea></td></tr>
        <tr><td>Quelle:</td>
        <td><input type="text" name="pledge[quotesource]" value="<?=$oldarray['quotesource'];?>" /></td></tr>
        <tr><td>URL:</td>
         <td><input type="text" name="pledge[quoteurl]" value="<?=$oldarray['quoteurl'];?>" /></td></tr>
        <tr><td>Seite im Wahlprogramm:</td>
        <td><input style="width: 50px;" type="text" name="pledge[quotepage]" value="<?=$oldarray['quotepage'];?>" /><br><small>Wenn angegeben, werden die Felder <em>Quelle</em> und <em>URL</em> ignoriert.</small></td></tr>
</table>

            <p><input type="submit" value="OK" /></p>
