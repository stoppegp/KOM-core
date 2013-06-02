<?php

function kom_autoload($class) {
    $classes = array(
        "database"  =>  "classes/database.class.php",
        "party"  =>  "classes/party.class.php",
        "category"  =>  "classes/category.class.php",
        "issue"  =>  "classes/issue.class.php",
        "pledge"  =>  "classes/pledge.class.php",
        "quote"  =>  "classes/quote.class.php",
        "state"  =>  "classes/state.class.php",
        "pledgestatetype"  =>  "classes/pledgestatetype.class.php",
        "pledgestatetypegroup"  =>  "classes/pledgestatetypegroup.class.php",
        "pledgestate"  =>  "classes/pledgestate.class.php",
        "analysis"  =>  "classes/analysis.class.php",
        "search"  =>  "classes/search.class.php",
    );
    if (in_array(strtolower($class), array_keys($classes))) {
        include_once $classes[strtolower($class)];
    }
}

spl_autoload_register("kom_autoload");

?>