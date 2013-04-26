<h2><?=_("Users");?></h2>

<p><a class="button newbutton" href="<? echo doadminlink("user_new"); ?>"><?=_("New user");?></a></p>

<? 
$users = $dblink->Select("users");

if (is_array($users)) {
    echo "<table class=\"bordertable\">";
    echo "<tr>";
    echo "<th>"._("ID")."</th>";
    echo "<th>"._("Username")."</th>";
    echo "<th>"._("Name")."</th>";
    echo "</tr>";
    foreach ($users as $value) {
        echo "<tr>";
        echo "<td>#".$value->id."</td>";
        echo "<td>".$value->username."</td>";
        echo "<td>".$value->name."</td>";
        echo "<td>";
        echo "<a class=\"listbutton\" href=\"".doadminlink("user_edit", array("userid" => $value->id))."\">"._("edit")."</a>";
        echo "<a class=\"listbutton delbutton\" href=\"".doadminlink("user_del", array("userid" => $value->id))."\">"._("delete")."</a>";
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}
?>

<?php



?>
