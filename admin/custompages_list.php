<h2><?=_("Pages");?></h2>

<p><a class="button newbutton" href="<? echo doadminlink("custompages_new"); ?>"><?=_("New page");?></a></p>

<? 
$custompages = $dblink->Select("custompages");

if (is_array($custompages)) {
    echo "<table class=\"bordertable\">";
    echo "<tr>";
    echo "<th>"._("ID")."</th>";
    echo "<th>"._("Label")."</th>";
    echo "</tr>";
    foreach ($custompages as $value) {
        echo "<tr>";
        echo "<td>#".$value->id."</td>";
        echo "<td>".$value->name."</td>";
        echo "<td>";
        echo "<a class=\"listbutton\" href=\"".doadminlink("custompages_edit", array("custompageid" => $value->id))."\">"._("edit")."</a>";
        echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("custompages_del", array("custompageid" => $value->id))."\">"._("delete")."</a>";
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}
?>

<?php



?>
