<?php
if (is_numeric(KOM::$active['custompageid'])) {
    $pages = KOM::$dblink->Select("custompages", "*", "WHERE `id`=".(int)KOM::$active['custompageid']);
    if (isset($pages[0])) {
        echo str_replace("[SITE_URL]", KOM::$site_url, $pages[0]->content);
    }
}

?>