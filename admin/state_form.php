<table class="bordertable">

    <tr>
        <td>
            <?=_("Text");?>:
        </td>
        <td>
            <input type="text" name="state[name]" value="<?=retisset($oldarray['name']);?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Date");?>:
        </td>
        <td>
            <input type="text" name="state[datum]" value="<?=retisset($oldarray['datum']);?>" />
        </td>
    </tr>
    <tr>
        <td><?=_("Source");?>:</td>
        <td>
            <?=_("Quote");?>:<br>
            <textarea name="state[quotetext]"><?=retisset($oldarray['quotetext']);?></textarea><br>
            <?=_("Source");?>:<br>
            <input type="text" name="state[quotesource]" value="<?=retisset($oldarray['quotesource']);?>" /><br>
            <?=_("URL");?>:<br>
            <input type="text" name="state[quoteurl]" value="<?=retisset($oldarray['quoteurl']);?>" /><br>
        </td>
    </tr>



</table>
<h4><?=_("Rating");?></h4>
<table class="bordertable">
    <?php
    if (is_array($thisissue->getPledges("party"))) {
        foreach ($thisissue->getPledges("party") as $value) {
            echo "<tr>";
            echo "<td>".$value->getParty()->getName().": ".$value->getName()."</td>";
            echo "<td>";
            echo "<select name=\"state[pledges][".$value->getID()."]\">";
            echo "<option value=\"0\">"._("No information")."</option>";
            foreach ($database->getPledgestatetypes("order") as $value2) {
                if ($value2->getType() == $value->getType()) {
                    if (isset($oldarray['pledges'][$value->getID()]) && ($oldarray['pledges'][$value->getID()] == $value2->getID())) {
                        echo "<option selected=\"selected\" value=\"".$value2->getID()."\">".$value2->getName()."</option>";
                    } else {
                        echo "<option value=\"".$value2->getID()."\">".$value2->getName()."</option>";
                    }
                }
            }
            echo "</select>";
            echo "</td>";
            echo "</tr>";
        }
    }
    
    ?>

</table>

<table>
    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="submit" value="OK" />
        </td>
    </tr>
</table>