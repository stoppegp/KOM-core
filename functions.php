<?php
function dolink($page = "", $arg = null, $clear = false) {
    global $active;
    if ($clear) {
        $nlactive = array();
    } else {
        $nlactive = $active;
    }
    unset($arg['page']);
    unset($nlactive['page']);
    if (is_array($arg)) {
        $nlactive = array_merge($nlactive, $arg);
    }
    unset($nlactive2);
    
    if ($page == "") {
        $page = $active['page'];
    }
    
    if (is_array($nlactive)) {
        foreach ($nlactive as $key => $val) {
            if ($val) {
                $nlactive2[] = $key."=".$val;
            }
        }
    }
    if (count($nlactive2) > 0) {
        return "index.php?page=".$page."&".implode("&amp;", $nlactive2);
    } else {
        return "index.php?page=".$page;
    }
}

function registerScript($content, $link = false) {
    global $KOM_SCRIPTS;
    if ($link) {
        $KOM_SCRIPTS[] = '<script type="text/javascript" src="'.$content.'"></script>';
    } else {
        $KOM_SCRIPTS[] = '<script type="text/javascript">"'.$content.'"</script>';
    }
}

function registerStyle($content, $link = false) {
    global $KOM_STYLES;
    if ($link) {
        $KOM_STYLES[] = '<link rel="stylesheet" type="text/css" href="'.$content.'" />';
    } else {
        $KOM_STYLES[] = '<style type="text/css">"'.$content.'"</style>';
    }
}

function getScripts() {
    global $KOM_SCRIPTS;
    if (is_array($KOM_SCRIPTS) && count($KOM_SCRIPTS)>0) {
        return implode("\n", $KOM_SCRIPTS);
    } else {
        return "";
    }
}

function getStyles() {
    global $KOM_STYLES;
    if (is_array($KOM_STYLES) && count($KOM_STYLES)>0) {
        return implode("\n", $KOM_STYLES);
    } else {
        return "";
    }
}

function registerMenu($menuarray) {
    global $KOM_MAINMENU;
    $KOM_MAINMENU = $menuarray;
}
?>