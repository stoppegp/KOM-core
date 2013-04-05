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
                        adminaddsuccess("Anmeldung erfolgreich.");
                    } else {
                        adminadderror("Anmeldung fehlgeschlagen: Falsches Kennwort");
                        $logouterror = true;
                    }
                    break;
                } 
            }
            
        }
        if (!$_SESSION['login'] && !$logouterror) {
            adminadderror("Anmeldung fehlgeschlagen: Benutzer exisitert nicht.");
            $logouterror = true;
        }

}

/* LOGOUT */
if (isset($_REQUEST['logout']) && $_REQUEST['logout'] == 'true') {
    session_destroy();
    session_start();
    adminaddsuccess("Du wurdest abgemeldet");
    $logouterror = true;
}

/* TIMEOUT */
if ((time()-$_SESSION['lastvisit']) > 1800 && $_SESSION['login']) {
    session_destroy();
    session_start();
    adminadderror("Du warst zu lange inaktiv und wurdest abgemeldet.");
    $logouterror = true;
}

/* USERSESSION AKTUALISIEREN */
if (isset($_SESSION['login'])) {
    try {
        $actuser0 = $dblink->Select("users", "*", "WHERE `id`=".$_SESSION['userid']);
        
        if (!is_array($actuser0)) {
            session_destroy();
            session_start();
            adminadderror("Der Benutzer wurde nicht gefunden.");
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
        adminadderror("Der Benutzer wurde nicht gefunden.");
        $logouterror = true;
    }
}

/* Zugriffskontrolle */
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    unset($adminactive);
    $adminactive['page'] = "login";
    if (!$logouterror) {
        adminadderror("Zugriff verweigert.");
    }
}

/* Admin-Kontrolle */
if ((strpos(" ".$adminactive['do'], "user") > 0) || (strpos(" ".$adminactive['page'], "user") > 0)) {
    if ($_SESSION['admin'] != 1) {
        $adminactive['do'] = "";
        $adminactive['page'] = "";
        adminadderror("Zugriff verweigert.");
    }
}

?>

