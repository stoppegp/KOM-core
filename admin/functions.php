<?php
function doadminlink($page = "", $arg = null) {
    global $adminactive;
    $nlactive = $adminactive;
    if (is_array($arg)) {
        $nlactive = array_merge($adminactive, $arg);
    }
    unset($nlactive2);
    
    if ($page != "") {
        $nlactive['page'] = $page;
    }
    
    if (!$arg['do']) {
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

?>