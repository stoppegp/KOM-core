<h2><?=_("Issues");?></h2>

<p><a class="button newbutton" href="<? echo doadminlink("issue_new"); ?>"><?=_("New issue");?></a></p>

<?php


if (is_array($database->getIssues("name")) && count($database->getIssues("name")) > 0) {
    
    $issuesbc = $database->getIssues("category");
    
        echo "<table class=\"bordertable issuelist\">";
        foreach ($database->getCategories("name") as $val) {
            echo "<tr><td class=\"big\" colspan=\"3\"><strong>".$val->getName()."</strong></td></tr>";
            if (isset($issuesbc[$val->getID()]) && is_array($issuesbc[$val->getID()])) {
                foreach ($issuesbc[$val->getID()] as $value) {
                    echo "<tr><td>#".$value->getID()."</td>";
                    echo "<td class=\"big\"><a href=\"".doadminlink("issue_show", array("issueid" => $value->getID()))."\">".$value->getName()."</a></td><td>";
                    echo "<a class=\"listbutton\" href=\"".doadminlink("issue_show", array("issueid" => $value->getID()))."\">"._("open")."</a>";
                    echo "<a class=\"listbutton\" href=\"".doadminlink("issue_edit", array("issueid" => $value->getID()))."\">"._("edit")."</a>";
                    echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("issue_del", array("issueid" => $value->getID()))."\">"._("delete")."</a>";
                    echo "</td></tr>";
                }
            } else {
                echo "<tr><td>&nbsp;</td><td colspan=\"2\">"._("No entries found.")."</td></tr>";
            }
        }
        echo "</table>";
    
} else {
    echo _("No entries found.");
}

?>
