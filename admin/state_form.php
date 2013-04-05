<table class="bordertable">

    <tr>
        <td>
            Text:
        </td>
        <td>
            <input type="text" name="state[name]" value="<?=$oldarray['name'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            Datum:
        </td>
        <td>
            <input type="text" name="state[datum]" value="<?=$oldarray['datum'];?>" />
        </td>
    </tr>
    <tr>
        <td>Quelle:</td>
        <td>
            Zitat:<br>
            <textarea name="state[quotetext]"><?=$oldarray['quotetext'];?></textarea><br>
            Quelle:<br>
            <input type="text" name="state[quotesource]" value="<?=$oldarray['quotesource'];?>" /><br>
            URL:<br>
            <input type="text" name="state[quoteurl]" value="<?=$oldarray['quoteurl'];?>" /><br>
        </td>
    </tr>



</table>
<h4>Bewertung</h4>
<table class="bordertable">
    <?php
    if (is_array($thisissue->getPledges("party"))) {
        foreach ($thisissue->getPledges("party") as $value) {
            echo "<tr>";
            echo "<td>".$value->getParty()->getName().": ".$value->getName()."</td>";
            echo "<td>";
            echo "<select name=\"state[pledges][".$value->getID()."]\">";
            echo "<option value=\"0\">Keine Information</option>";
            foreach ($database->getPledgestatetypes("order") as $value2) {
                if ($value2->getType() == $value->getType()) {
                    if ($oldarray['pledges'][$value->getID()] == $value2->getID()) {
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