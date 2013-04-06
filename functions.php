<?php
$KOM_DOLINK = "stdDoLink";
$KOM_REWRITE = "stdRewrite";

function dolink($page = "", $arg = null, $clear = false) {
    global $active;
    global $KOM_DOLINK;
    
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
    
    return $KOM_DOLINK($page, $nlactive);
}

function setDoLink($func) {
    global $KOM_DOLINK;
    $KOM_DOLINK = $func;
}

function setRewrite($func) {
    global $KOM_REWRITE;
    $KOM_REWRITE = $func;
}

function stdDoLink($page, $nlactive) {
    if (is_array($nlactive)) {
        foreach ($nlactive as $key => $val) {
            if ($val) {
                $nlactive2[] = $key."=".$val;
            }
        }
    }
    if (count($nlactive2) > 0) {
        return SITE_URL."/index.php?page=".$page."&".implode("&amp;", $nlactive2);
    } else {
        return SITE_URL."/index.php?page=".$page;
    }
}

function stdRewrite($uri){
    $active['page'] = $_GET['page'];

    if ($active['page'] == "") {
        $active['page'] = "home";
    }

    if (!file_exists("interface/".$active['page'].".php")) {
        $active['page'] = "error/404";
    }
    return $active;
}

function registerScript($content, $link = false) {
    global $KOM_SCRIPTS;
    if ($link) {
        $KOM_SCRIPTS[] = '<script type="text/javascript" src="'.SITE_URL."/".$content.'"></script>';
    } else {
        $KOM_SCRIPTS[] = '<script type="text/javascript">"'.$content.'"</script>';
    }
}

function registerStyle($content, $link = false) {
    global $KOM_STYLES;
    if ($link) {
        $KOM_STYLES[] = '<link rel="stylesheet" type="text/css" href="'.SITE_URL."/".$content.'" />';
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