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
<h2><?=_("Groups");?>
<?php
$pledgestatetypegroups = $dblink->Select("pledgestatetypegroups");

if (is_array($pledgestatetypegroups)) {
    echo "<h3>"._("Pre-installed")."</h3>";
    echo "<table class=\"bordertable\">";
    echo "<tr>";
    echo "<th>"._("ID")."</th>";
    echo "<th>"._("Type")."</th>";
    echo "<th>"._("Label")."</th>";
    echo "</tr>";
    foreach ($pledgestatetypegroups as $value) {
        if (!in_array($value->id, array(1,2,3))) continue;
        echo "<tr>";
        echo "<td>#".$value->id."</td>";
        echo "<td>";
        switch ($value->id) {
            case 1: echo _("Nothing happened"); break;
            case 2: echo _("Promise kept"); break;
            case 3: echo _("Promise broken"); break;
        }
        echo "</td>";
        echo "<td>".$value->name."</td>";
        echo "<td>";
        echo "<a class=\"listbutton\" href=\"".doadminlink("pledgestatetypegroup_edit", array("pledgestatetypegroupid" => $value->id))."\">"._("edit")."</a>";
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</table>";

    echo "<h3>"._("Custom groups")."</h3>";
    ?> <p><a class="button newbutton" href="<? echo doadminlink("pledgestatetypegroup_new"); ?>"><?=_("New Group");?></a></p> <?
    echo "<table class=\"bordertable\">";
    echo "<tr>";
    echo "<th>"._("ID")."</th>";
    echo "<th>"._("Type")."</th>";
    echo "<th>"._("Label")."</th>";
    echo "</tr>";
    foreach ($pledgestatetypegroups as $value) {
        if (in_array($value->id, array(1,2,3))) continue;
        echo "<tr>";
        echo "<td>"._("custom")."</td>";
        echo "<td>".$value->name."</td>";
        echo "<td>";
        echo "<a class=\"listbutton\" href=\"".doadminlink("pledgestatetypegroup_edit", array("pledgestatetypegroupid" => $value->id))."\">"._("edit")."</a>";
        echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("pledgestatetypegroup_del", array("pledgestatetypegroupid" => $value->id))."\">"._("delete")."</a>";
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</table>";

}


?>
