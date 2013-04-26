<h2>Bewertungen</h2>

<p><a class="button newbutton" href="<? echo doadminlink("pledgestatetype_new"); ?>">Neue Bewertung</a></p>

<? 
$pledgestatetypes = $dblink->Select("pledgestatetypes");

if (is_array($pledgestatetypes)) {
    echo "<h3>Typ: Forderung</h3>";
    echo "<table class=\"bordertable\">";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Name</th>";
    echo "</tr>";
    foreach ($pledgestatetypes as $value) {
        if ($value->type != 0) continue;
        echo "<tr>";
        echo "<td>#".$value->id."</td>";
        echo "<td>".$value->name."</td>";
        echo "<td>";
        echo "<a class=\"listbutton\" href=\"".doadminlink("pledgestatetype_edit", array("pledgestatetypeid" => $value->id))."\">bearbeiten</a>";
        echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("pledgestatetype_del", array("pledgestatetypeid" => $value->id))."\">löschen</a>";
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</table>";

    echo "<h3>Typ: Zustand</h3>";
    echo "<table class=\"bordertable\">";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Bezeichnung</th>";
    echo "</tr>";
    foreach ($pledgestatetypes as $value) {
        if ($value->type != 1) continue;
        echo "<tr>";
        echo "<td>#".$value->id."</td>";
        echo "<td>".$value->name."</td>";
        echo "<td>";
        echo "<a class=\"listbutton\" href=\"".doadminlink("pledgestatetype_edit", array("pledgestatetypeid" => $value->id))."\">bearbeiten</a>";
        echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("pledgestatetype_del", array("pledgestatetypeid" => $value->id))."\">löschen</a>";
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}
?>

<?php



?>
