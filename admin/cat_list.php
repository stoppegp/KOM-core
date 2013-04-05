<h2>Kategorien</h2>

<p><a class="button newbutton" href="<? echo doadminlink("cat_new"); ?>">Neuer Eintrag</a></p>

<?php


if (is_array($database->getCategories("name")) && count($database->getCategories("name")) > 0) {
    echo "<table class=\"bordertable issuelist\">";
    
    foreach ($database->getCategories("name") as $value) {

        echo "<tr><td>#".$value->getID()."</td>";
        echo "<td class=\"big\">".$value->getName()."</td><td>";
        echo "<a class=\"listbutton\" href=\"".doadminlink("cat_edit", array("catid" => $value->getID()))."\">bearbeiten</a>";
        echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("cat_del", array("catid" => $value->getID()))."\">löschen</a>";
        echo "</td></tr>";
    }
    

    echo "</table>";
} else {
    echo "Keine Einträge vorhanden.";
}

?>
