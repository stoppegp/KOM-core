<?php

/* LOGIN */
if (isset($_REQUEST['login'])) {
     $users = $dblink->Select("users");
      $username = $_POST['username'];
      $passwort = $_POST['passwort'];
        
        
        
        if (is_array($users)) {
            foreach ($users as $val) {
                if ($username == $val->username) {
                    if (sha1($passwort) == $val->password) {
                        $_SESSION['login'] = true;
                        $_SESSION['user'] = $val->name;
                        $_SESSION['userid'] = $val->id;
                        $_SESSION['admin'] = $val->admin;
                        $_SESSION['lastvisit'] = time();
                        adminaddsuccess(_("Login successful."));
                    } else {
                        adminadderror(_("Login error: Wrong password."));
                        $logouterror = true;
                    }
                    break;
                } 
            }
            
        }
        if (!isset($_SESSION['login']) && !isset($logouterror)) {
            adminadderror(_("Login error: User does not exist."));
            $logouterror = true;
        }

}

/* LOGOUT */
if (isset($_REQUEST['logout']) && $_REQUEST['logout'] == 'true') {
    session_destroy();
    session_start();
    adminaddsuccess(_("You are logged out."));
    $logouterror = true;
}

/* TIMEOUT */
if (isset($_SESSION['lastvisit']) && ((time()-$_SESSION['lastvisit']) > 1800 && $_SESSION['login'])) {
    session_destroy();
    session_start();
    adminadderror(_("You were inactive for too long and ahve been logged out."));
    $logouterror = true;
}

/* USERSESSION AKTUALISIEREN */
if (isset($_SESSION['login'])) {
    try {
        $actuser0 = $dblink->Select("users", "*", "WHERE `id`=".$_SESSION['userid']);
        
        if (!is_array($actuser0)) {
            session_destroy();
            session_start();
            adminadderror(_("User not found."));
            $logouterror = true;
        } else {
            $actuser = $actuser0[0];
            $_SESSION['userid'] = $actuser->id;
            $_SESSION['user'] = $actuser->name;
            $_SESSION['admin'] = $actuser->admin;
            $_SESSION['lastvisit'] = time();
        }
        
    } catch (DBError $e) {
        session_destroy();
        session_start();
        adminadderror(_("User not found."));
        $logouterror = true;
    }
}

/* Zugriffskontrolle */
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    unset($adminactive);
    $adminactive['page'] = "login";
    if (!isset($logouterror)) {
        adminadderror(_("Access denied."));
    }
}

/* Admin-Kontrolle */
if (((isset($adminactive['do'])) && (strpos(" ".$adminactive['do'], "user") > 0)) || (isset($adminactive['page']) && (strpos(" ".$adminactive['page'], "user") > 0))) {
    if ($_SESSION['admin'] != 1) {
        $adminactive['do'] = "";
        $adminactive['page'] = "";
        adminadderror(_("Access denied."));
    }
}

?>

