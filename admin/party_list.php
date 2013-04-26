<h2>Parteien</h2>

<p><a class="button newbutton" href="<? echo doadminlink("party_new"); ?>">Neue Partei</a></p>

<? 
$users = $dblink->Select("parties");

if (is_array($users)) {
    echo "<table class=\"bordertable\">";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Name</th>";
    echo "</tr>";
    foreach ($users as $value) {
        echo "<tr>";
        echo "<td>#".$value->id."</td>";
        echo "<td>".$value->name."</td>";
        echo "<td>";
        echo "<a class=\"listbutton\" href=\"".doadminlink("party_edit", array("partyid" => $value->id))."\">bearbeiten</a>";
        echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("party_del", array("partyid" => $value->id))."\">löschen</a>";
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}
?>

<?php



?>
