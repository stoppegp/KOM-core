<?php
if (is_numeric(KOM::$active['custompageid'])) {
    $pages = KOM::$dblink->Select("custompages", "*", "WHERE `id`=".(int)KOM::$active['custompageid']);
    if (isset($pages[0])) {
        echo $pages[0]->content;
    }
}

?>