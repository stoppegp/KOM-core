
<?php
$thisissueid = $adminactive['issueid'];
if (!$database->getIssue($thisissueid)) {
    echo "Die Issue-ID wurde nicht gefunden.";
} else {
    $thisissue = &$database->getIssue($thisissueid);
    ?>
    
    <h2>Thema <?=$thisissue->getID();?> – <?=$thisissue->getName();?></h2>
    <h3 class="trenner">Versprechen</h3>
    <p><a class="button newbutton" href="<? echo doadminlink("pledge_new"); ?>">Neues Versprechen</a></p>
    <?
    echo "<table class=\"bordertable issuelist\"";
    foreach ($database->getParties("order") as $val) {
        echo "<tr><td class=\"big\" colspan=\"3\"><strong>".$val->getName()."</strong></td></tr>";
        if (is_array($thisissue->getPledgesOfParty($val->getID()))) {
            foreach ($thisissue->getPledgesOfParty($val->getID()) as $value) {
                echo "<tr><td>#".$value->getID()."</td>";
                echo "<td class=\"big\">".$value->getName()."</td><td>";
                echo "<a class=\"listbutton\" href=\"".doadminlink("pledge_edit", array("pledgeid" => $value->getID()))."\">bearbeiten</a>";
                echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("pledge_del", array("pledgeid" => $value->getID()))."\">löschen</a>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td>&nbsp;</td><td colspan=\"2\">Keine Einträge.</td></tr>";
        }
    }
echo "</table>";
?>
<h3 class="trenner">Verlauf</h3>
<p><a class="button newbutton" href="<? echo doadminlink("state_new"); ?>">Neuer Status</a></p>
<?    

if (count($thisissue->getStates("datum", "DESC")) > 0) {
    echo "<table class=\"bordertable issuelist\">";
    foreach ($thisissue->getStates("datum", "DESC") as $value) {
        echo "<tr>";
        echo "<td>".date("d.m.Y", $value->getDatum())."</td>";
        echo "<td class=\"big\">".$value->getName()."</td>";
        echo "<td>";
        echo "<a class=\"listbutton\" href=\"".doadminlink("state_edit", array("stateid" => $value->getID()))."\">bearbeiten</a>";
        echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("state_del", array("stateid" => $value->getID()))."\">löschen</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
    
}

?>
<hr /><p><a class="backlink button" href="<?=doadminlink("issue_list");?>">Zurück</a></p>