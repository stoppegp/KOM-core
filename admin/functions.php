<?php
function doadminlink($page = "", $arg = null, $clear = false) {
    global $adminactive;
    if (!$clear) {
        $adminactive2 = $adminactive;
    } else {
        $adminactive2 = array();
    }
    $nlactive = $adminactive2;
    if (is_array($arg)) {
        $nlactive = array_merge($adminactive2, $arg);
    }
    unset($nlactive2);
    
    if ($page != "") {
        $nlactive['page'] = $page;
    }
    
    if (!isset($arg['do'])) {
        unset($nlactive['do']);
    }
    
    if (is_array($nlactive)) {
        foreach ($nlactive as $key => $val) {
            $nlactive2[] = $key."=".$val;
        }
        return "admin.php?".implode("&amp;", $nlactive2);
    } else {
        return "admin.php?".$page;
    }
}

function adminadderror($c) {
    global $adminerrors;
    $adminerrors[] = $c;
}
function adminaddsuccess($c) {
    global $adminsuccs;
    $adminsuccs[] = $c;
}

function redirect($adminactive, $success = false, $error = false) {
    global $adminsuccs;
    if (isset($adminactive['do'])) unset($adminactive['do']);
    $page = $adminactive['page'];
    unset($adminactive['page']);
    if ($success && in_array($success, array("add", "del", "edit"))) {
         $adminactive['success'] = $success;
    }
    if ($error && in_array($error, array("notfound", "last", "ratingassigned", "ratingpreinstalled", "db"))) {
         $adminactive['error'] = $error;
    }
    header('Location: '.htmlspecialchars_decode(doadminlink($page, $adminactive, true)));
    exit;
}

function retisset(&$val) {
    if (isset($val)) return $val;
    return "";
}

?>