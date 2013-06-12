
<?php
$thisissueid = $adminactive['issueid'];
if (!is_numeric($thisissueid) || !$database->getIssue($thisissueid)) {
    redirect(array("page" => "issue_list"), null, "notfound");
}
    $thisissue = $database->getIssue($thisissueid);
    ?>
    
    <h2><?=_("Issue");?> <?=$thisissue->getID();?> – <?=$thisissue->getName();?></h2>
    <h3 class="trenner"><?=_("Promises");?></h3>
    <?
    if (is_array($database->getParties("order")) && (count($database->getParties("order")) > 0)) {
        ?> <p><a class="button newbutton" href="<? echo doadminlink("pledge_new"); ?>"><?=_("New Promise");?></a></p> <?
        echo "<table class=\"bordertable issuelist\">";
        foreach ($database->getParties("order") as $val) {
            echo "<tr><td class=\"big\" colspan=\"3\"><strong>".$val->getName()."</strong></td></tr>";
            if (is_array($thisissue->getPledgesOfParty($val->getID()))) {
                foreach ($thisissue->getPledgesOfParty($val->getID()) as $value) {
                    echo "<tr><td>#".$value->getID()."</td>";
                    echo "<td class=\"big\">".$value->getName()."</td><td>";
                    echo "<a class=\"listbutton\" href=\"".doadminlink("pledge_edit", array("pledgeid" => $value->getID()))."\">"._("edit")."</a>";
                    echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("pledge_del", array("pledgeid" => $value->getID()))."\">"._("delete")."</a>";
                    echo "</td></tr>";
                }
            } else {
                echo "<tr><td>&nbsp;</td><td colspan=\"2\">"._("No entries found.")."</td></tr>";
            }
        }
        echo "</table>";
    } else {
        echo "<p>"._("You have to create at least one party before your can create promises.")."</p>";
    }

?>
<h3 class="trenner"><?=_("Progress");?></h3>
<p><a class="button newbutton" href="<? echo doadminlink("state_new"); ?>"><?=_("New state");?></a></p>
<?    

if (count($thisissue->getStates("datum", "DESC")) > 0) {
    echo "<table class=\"bordertable issuelist\">";
    foreach ($thisissue->getStates("datum", "DESC") as $value) {
        echo "<tr>";
        echo "<td>".date("d.m.Y", $value->getDatum())."</td>";
        echo "<td class=\"big\">".$value->getName()."</td>";
        echo "<td>";
        echo "<a class=\"listbutton\" href=\"".doadminlink("state_edit", array("stateid" => $value->getID()))."\">"._("edit")."</a>";
        echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("state_del", array("stateid" => $value->getID()))."\">"._("delete")."</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>"._("No entries found.")."</p>";
}
    

?>
<hr /><p><a class="backlink button" href="<?=doadminlink("issue_list", null, true);?>"><?=_("Back");?></a></p>