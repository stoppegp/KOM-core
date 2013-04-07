<h2>Seiten</h2>

<p><a class="button newbutton" href="<? echo doadminlink("custompages_new"); ?>">Neue Seite</a></p>

<? 
$custompages = $dblink->Select("custompages");

if (is_array($custompages)) {
    echo "<table class=\"bordertable\">";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Name</th>";
    echo "</tr>";
    foreach ($custompages as $value) {
        echo "<tr>";
        echo "<td>#".$value->id."</td>";
        echo "<td>".$value->name."</td>";
        echo "<td>";
        echo "<a class=\"listbutton\" href=\"".doadminlink("custompages_edit", array("custompageid" => $value->id))."\">bearbeiten</a>";
        echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("custompages_del", array("custompageid" => $value->id))."\">löschen</a>";
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}
?>

<?php



?>
