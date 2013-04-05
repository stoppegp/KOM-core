<h2>Benutzer</h2>

<p><a class="button newbutton" href="<? echo doadminlink("user_new"); ?>">Neuer Benutzer</a></p>

<? 
$users = $dblink->Select("users");

if (is_array($users)) {
    echo "<table class=\"bordertable\">";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Benutzername</th>";
    echo "<th>Name</th>";
    echo "</tr>";
    foreach ($users as $value) {
        echo "<tr>";
        echo "<td>#".$value->id."</td>";
        echo "<td>".$value->username."</td>";
        echo "<td>".$value->name."</td>";
        echo "<td>";
        echo "<a class=\"listbutton\" href=\"".doadminlink("user_edit", array("userid" => $value->id))."\">bearbeiten</a>";
        echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("user_del", array("userid" => $value->id))."\">löschen</a>";
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}
?>

<?php



?>
