<h2><?=_("Ratings");?></h2>

<p><a class="button newbutton" href="<? echo doadminlink("pledgestatetype_new"); ?>"><?=_("New Rating");?></a></p>

<? 
$pledgestatetypes = $dblink->Select("pledgestatetypes");

if (is_array($pledgestatetypes)) {
    echo "<h3>"._("Type").": "._("Request")."</h3>";
    echo "<table class=\"bordertable\">";
    echo "<tr>";
    echo "<th>"._("ID")."</th>";
    echo "<th>"._("Label")."</th>";
    echo "</tr>";
    foreach ($pledgestatetypes as $value) {
        if ($value->type != 0) continue;
        echo "<tr>";
        echo "<td>#".$value->id."</td>";
        echo "<td>".$value->name."</td>";
        echo "<td>";
        echo "<a class=\"listbutton\" href=\"".doadminlink("pledgestatetype_edit", array("pledgestatetypeid" => $value->id))."\">"._("edit")."</a>";
        echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("pledgestatetype_del", array("pledgestatetypeid" => $value->id))."\">"._("delete")."</a>";
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</table>";

    echo "<h3>"._("Type").": "._("Status quo")."</h3>";
    echo "<table class=\"bordertable\">";
    echo "<tr>";
    echo "<th>"._("ID")."</th>";
    echo "<th>"._("Label")."</th>";
    echo "</tr>";
    foreach ($pledgestatetypes as $value) {
        if ($value->type != 1) continue;
        echo "<tr>";
        echo "<td>#".$value->id."</td>";
        echo "<td>".$value->name."</td>";
        echo "<td>";
        echo "<a class=\"listbutton\" href=\"".doadminlink("pledgestatetype_edit", array("pledgestatetypeid" => $value->id))."\">"._("edit")."</a>";
        echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("pledgestatetype_del", array("pledgestatetypeid" => $value->id))."\">"._("delete")."</a>";
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}
?>

<?php



?>
