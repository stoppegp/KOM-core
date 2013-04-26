<table class="bordertable">

    <tr>
        <td>
            <?=_("Label:");?>
        </td>
        <td>
            <input type="text" name="custompages[name]" value="<?=$oldarray['name'];?>" />
        </td>
    </tr>
    <tr>
        <td>
            <?=_("Content:");?>
        </td>
        <td>
            <textarea  name="custompages[content]"><? echo htmlspecialchars($oldarray['content']); ?></textarea>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="submit" value="OK" />
        </td>
    </tr>


</table>