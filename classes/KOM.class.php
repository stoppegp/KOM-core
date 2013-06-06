<?php

class KOM {

    static $dblink;
    static $mainDB;
    static $pagetitle;
    static $site_url;
    static $pagenames;

    static $pages;
    static $pagesByFile;
    static $active;
    static $scripts;
    static $styles;
    static $menus;
    
    static $issuelist;
    static $custompagelist;
    
    static function loadIssuelist() {
        $tempar = KOM::$dblink->Select("issues", "id, name");
        if (is_array($tempar)) {
            foreach($tempar as $value) {
                KOM::$issuelist[$value->id] = KOM::filteruri($value->name);
            }
        }
    }
    
    static function loadCustompagelist() {
        $tempar = KOM::$dblink->Select("custompages", "id, name");
        if (is_array($tempar)) {
            foreach($tempar as $value) {
                KOM::$custompagelist[$value->id] = $value->name;
            }
        }
    }
    
    static function registerPage($page) {
        $name = $page['name'];
        $file = $page['file'];
        KOM::$pages[$name]  = $page;
        KOM::$pagesByFile[$file] = $page;
    }
    static function registerPages($pages) {
        if (is_array($pages)) {
            foreach ($pages as $value) {
                $name = $value['name'];
                $file = $value['file'];
                KOM::$pages[$name] = $value;
                KOM::$pagesByFile[$file] = $value;
            }
        }
    }
    
    static function registerMenu($name, $menu) {
        KOM::$menus[$name] = $menu;
    }
    
    static function addtoMenu($name, $item, $position = false) {
        if (!is_array(KOM::$menus[$name])) {
            KOM::$menus[$name] = array();
            KOM::$menus[$name][] = $item;
        } elseif (!is_numeric($position)) {
            KOM::$menus[$name][] = $item;
        } else {
            array_splice( KOM::$menus[$name], $position, 0, array($item) );
        }
    }
    
    static function getMenu($name) {
        if (!is_array(KOM::$menus[$name])) return;
        
        foreach (KOM::$menus[$name] as $value) {
            if (isset($value['showonlywhenactive']) && ($value['showonlywhenactive'] == true)) continue;
            if (is_array($value['active'])) {
                $ret0['active'] = true;
                foreach($value['active'] as $key => $val) {
                    if (KOM::$active[$key] != $val) {
                        $ret0['active'] = false;
                        break;
                    }
                }
            }
            
            $ret0['text'] = $value['text'];
            $ret0['id'] = $value['id'];
			if (!isset($value['args'])) $value['args'] = null;
			if (!isset($value['args'])) $value['clearargs'] = null;
            $ret0['link'] = KOM::dolink($value['page'], $value['args'], $value['clearargs']);
            
            $ret[] = $ret0;
            
        }
        return $ret;
    }
    
    static function dolink($page = "", $arg = null, $clear = false) {
            if ($clear) {
                $nlactive = array();
            } else {
                $nlactive = KOM::$active;
            }
            $arg['page'] = null;
            unset($nlactive['page']);
            if (is_array($arg)) {
                $nlactive = array_merge($nlactive, $arg);
            }
            unset($nlactive2);
            
            if ($page == "") {
                $page = KOM::$active['page'];
            }
            $array = $nlactive;
            
            
            if (is_array(KOM::$pages) && in_array($page, array_keys(KOM::$pagesByFile))) {
                $url = KOM::$pagesByFile[$page]['name']."/";
				if (isset(KOM::$pagesByFile[$page]['doLink'])) {
					$callback = KOM::$pagesByFile[$page]['doLink'];
				}
                if (isset($callback) && function_exists($callback)) $url .= $callback($array);
            } else {
                switch ($page) {
                    case "list":
                        if (KOM::$pagenames['list'] != "") {
                            $url = KOM::$pagenames['list']."/";
                        } else {
                            $url = "";
                        }
                        if (isset($array['cat'])) {
                            $url .= KOM::filteruri(KOM::$mainDB->getCategory($array['cat'])->getName())."/";
                        } else {
                            $url = KOM::$pagenames['list-all']."/";
                        }
                    break;
                    case "single":
                        if (KOM::$pagenames['single'] != "") {
                            $url = KOM::$pagenames['single']."/";
                        } else {
                            $url = "";
                        }
                        $issueid = $array['issueid'];
                        $url .= $issueid."--".KOM::$issuelist[$issueid]."/";
                    break;
                    case "report":
                        if (KOM::$pagenames['report'] != "") {
                            $url = KOM::$pagenames['report']."/";
                        } else {
                            $url = "";
                        }
						if (isset($array['issueid'])) {
							$issueid = $array['issueid'];
							$url .= $issueid."--".KOM::$issuelist[$issueid]."/";
						} else {
							$url = "";
						}
                    break;
                    case "custompage":
                        if (isset($array['custompageid']) && is_array(KOM::$custompagelist) && in_array($array['custompageid'], array_keys(KOM::$custompagelist))) {
                            $custompageid = $array['custompageid'];
                            $url = KOM::$custompagelist[$custompageid]."/";
                        }
                    break;

                    case "home":
                        $url = "";
                    break;
                }
            }
            return KOM::$site_url."/".$url;
    
    }
    
    static function urlrewrite($uri) {
        
        if (is_array(KOM::$mainDB->getCategories())) {
            foreach (KOM::$mainDB->getCategories() as $val) {
                $catarray[KOM::filteruri($val->getName())] = $val->getID();
            }
        }
        if (is_array(KOM::$dblink->Select("custompages"))) {
            foreach (KOM::$dblink->Select("custompages") as $val) {
                $cparray[$val->name] = $val->id;
            }
        }
        $active['page'] = "home";

        $urisplit = explode("/", $uri);
        
        if (is_array($urisplit) && count($urisplit) > 0) {
            foreach ($urisplit as $value) {
                if ($value != "") {
                    $uriparts[] = $value;
                }
            }
        }
        
         if (isset($uriparts) && is_array($uriparts)) {
            
            $endrewrite = false;
         
            /* Interface-Page */
            if (!$endrewrite && is_array(KOM::$pages)) {
                for ($a = 0; $a < count($uriparts); $a++) {
                    $tempname = implode("/", array_slice($uriparts, 0, (count($uriparts)-$a)));
                    if (in_array($tempname, array_keys(KOM::$pages))) {
                        $active['page'] = KOM::$pages[$tempname]['file'];
						if (isset(KOM::$pages[$tempname]['urlrewrite'])) {
							$callback = KOM::$pages[$tempname]['urlrewrite'];
						}
                        if (isset($callback) && function_exists($callback)) {
                            $active2 = $callback($uriparts);
                            if (is_array($active2)) {
                                $active = array_merge($active2, $active);
                            }
                        }
                        $endrewrite = true;
                        break;
                    }
                }
            }
            
            /* Page 'single' */
            if (!$endrewrite) {
                if (KOM::$pagenames['single'] != "") {
                    if (strpos(" ".KOM::$pagenames['single'], "/") > 0) {
                    
                        for ($a = 0; $a < count($uriparts); $a++) {
                            $tempname = implode("/", array_slice($uriparts, 0, $a));
                            if ($tempname == KOM::$pagenames['single']) {
                                $lastnr = count($uriparts)-1;
                                if (strpos($uriparts[$lastnr], "--") > 0) {
                                    $nrstr = substr($uriparts[$lastnr], 0, strpos($uriparts[$lastnr], "-"));
                                    if (is_numeric($nrstr)) {
                                        $active['page'] = "single";
                                        $active['issueid'] = $nrstr;
                                        $endrewrite = true;
                                    }
                                }
                                break;
                            }
                        }
                        
                    } else {
                        $tempname = $uriparts[0];
                        if ($tempname == KOM::$pagenames['single']) {
                            if (strpos($uriparts[1], "--") > 0) {
                                $nrstr = substr($uriparts[1], 0, strpos($uriparts[1], "-"));
                                if (is_numeric($nrstr)) {
                                    $active['page'] = "single";
                                    $active['issueid'] = $nrstr;
                                    $endrewrite = true;
                                }
                            }
                        }
                    }
                } else {
                    if (strpos($uriparts[0], "--") > 0) {
                        $nrstr = substr($uriparts[0], 0, strpos($uriparts[0], "-"));
                        if (is_numeric($nrstr)) {
                            $active['page'] = "single";
                            $active['issueid'] = $nrstr;
                            $endrewrite = true;
                        }
                    }
                }
            }
            
            /* Page 'report' */
            if (!$endrewrite) {
                if (KOM::$pagenames['report'] != "") {
                    if (strpos(" ".KOM::$pagenames['report'], "/") > 0) {
                    
                        for ($a = 0; $a < count($uriparts); $a++) {
                            $tempname = implode("/", array_slice($uriparts, 0, $a));
                            if ($tempname == KOM::$pagenames['report']) {
                                $active['page'] = "report";
                                $lastnr = count($uriparts)-1;
                                if (strpos($uriparts[$lastnr], "--") > 0) {
                                    $nrstr = substr($uriparts[$lastnr], 0, strpos($uriparts[$lastnr], "-"));
                                    if (is_numeric($nrstr)) {
                                        $active['issueid'] = $nrstr;
                                    }
                                }
                                $endrewrite = true;
                                break;
                            }
                        }
                        
                    } else {
                        $tempname = $uriparts[0];
                        if ($tempname == KOM::$pagenames['report']) {
                            $active['page'] = "report";
                            if (strpos($uriparts[1], "--") > 0) {
                                $nrstr = substr($uriparts[1], 0, strpos($uriparts[1], "-"));
                                if (is_numeric($nrstr)) {
                                    $active['issueid'] = $nrstr;
                                }
                            }
                            $endrewrite = true;
                        }
                    }
                }
            }
            
            /* Page 'list' */
            if (!$endrewrite) {
                if (KOM::$pagenames['list'] != "") {
                    
                    if (strpos(" ".KOM::$pagenames['list'], "/") > 0) {
                    
                        for ($a = 0; $a < count($uriparts); $a++) {
                            $tempname = implode("/", array_slice($uriparts, 0, $a));
                            if ($tempname == KOM::$pagenames['list']) {
                                $lastnr = count($uriparts)-1;
                                if (in_array(KOM::filteruri($uriparts[$lastnr]), array_keys($catarray))) {
                                    $active['page'] = "list";
                                    $active['cat'] = $catarray[KOM::filteruri($uriparts[$lastnr])];
                                    $endrewrite = true;
                                }
                                break;
                            }
                        }
                        
                    } else {
                        $tempname = $uriparts[0];
                        if ($tempname == KOM::$pagenames['list']) {
                            if (in_array(KOM::filteruri($uriparts[1]), array_keys($catarray))) {
                                $active['page'] = "list";
                                $active['cat'] = $catarray[KOM::filteruri($uriparts[1])];
                                $endrewrite = true;
                            }
                        }
                    }
                } else {
                    if (in_array(KOM::filteruri($uriparts[0]), array_keys($catarray))) {
                        $active['page'] = "list";
                        $active['cat'] = $catarray[KOM::filteruri($uriparts[0])];
                        $endrewrite = true;
                    }
                }
            }
            
            /* Page 'list-all' */
            if (!$endrewrite) {
                if (KOM::$pagenames['list-all'] != "") {
                    
                    if (strpos(" ".KOM::$pagenames['list-all'], "/") > 0) {
                    
                        for ($a = 0; $a < count($uriparts); $a++) {
                            $tempname = implode("/", array_slice($uriparts, 0, $a));
                            if ($tempname == KOM::$pagenames['list-all']) {
                                $active['page'] = "list";
                                $endrewrite = true;
                                break;
                            }
                        }
                        
                    } else {
                        $tempname = $uriparts[0];
                        if ($tempname == KOM::$pagenames['list-all']) {
                            $active['page'] = "list";
                            $endrewrite = true;
                        }
                    }
                }
            }
            
            /* Custom-Page */
            if (!$endrewrite) {
                for ($a = 0; $a < count($uriparts); $a++) {
                    $tempname = implode("/", array_slice($uriparts, 0, (count($uriparts)-$a)));
                    if (in_array($tempname, KOM::$custompagelist)) {
                        $active['page'] = "custompage";
                        $temp0 = array_flip(KOM::$custompagelist);
                        $active['custompageid'] = $temp0[$tempname];
                        $endrewrite = true;
                        break;
                    }
                }
            }
        }
        
        /*
        if ($urisplit[1] == "kategorie") {
            unset($active);
            $active['page'] = "category";
            
            if (in_array(KOM::filteruri($urisplit[2]), array_keys($catarray))) {
                $active['cat'] = $catarray[KOM::filteruri($urisplit[2])];
            }
            
        }
        

        
        if ($urisplit[1] == "chronik") {
            unset($active);
            $active['page'] = "chronik";
        }
        
        if ($urisplit[1] == "statistik") {
            unset($active);
            $active['page'] = "ausw";
        }
        
        if ($urisplit[1] == "alles") {
            unset($active);
            $active['page'] = "list";
        }
        if ($urisplit[1] == "thema") {
            if (strpos($urisplit[2], "-") > 0) {
                $nrstr = substr($urisplit[2], 0, strpos($urisplit[2], "-"));
                if (is_numeric($nrstr)) {
                    unset($active);
                    $active['page'] = "single";
                    $active['issueid'] = $nrstr;
                }
            }

        }
        if ($urisplit[1] == "gehalten-gebrochen") {
            unset($active);
            $active['page'] = "geh";
        }       
        
        if (($urisplit[1] == "seite") && (isset($urisplit[2]))) {
            unset($active);
            $active['page'] = "custompage";
            if (in_array($urisplit[2], array_keys($cparray))) {
                $active['custompageid'] = $cparray[$urisplit[2]];
            } else {
                $active['custompageid'] = $urisplit[2];
            }
        } 

        if (in_array($urisplit[1], array_keys($cparray))) {
            unset($active);
            $active['page'] = "custompage";
            $active['custompageid'] = $cparray[$urisplit[1]];
        }
        
        if (is_array(KOM::$pages) && in_array($urisplit[1], array_keys(KOM::$pages))) {
            unset($active);
            $name = $urisplit[1];
            $active['page'] = KOM::$pages[$name]['file'];
        }
        */
        return $active;
    }

    static function registerScript($content, $link = false) {
        if ($link) {
            KOM::$scripts[] = '<script type="text/javascript" src="'.SITE_URL."/".$content.'"></script>';
        } else {
            KOM::$scripts[] = '<script type="text/javascript">"'.$content.'"</script>';
        }
    }

    static function registerStyle($content, $link = false) {
        if ($link) {
            KOM::$styles[] = '<link rel="stylesheet" type="text/css" href="'.SITE_URL."/".$content.'" />';
        } else {
            KOM::$styles[] = '<style type="text/css">"'.$content.'"</style>';
        }
    }
    
    static function getScripts() {
        if (is_array(KOM::$scripts) && count(KOM::$scripts)>0) {
            return implode("\n", KOM::$scripts);
        } else {
            return "";
        }
    }

    static function getStyles() {
        if (is_array(KOM::$styles) && count(KOM::$styles)>0) {
            return implode("\n", KOM::$styles);
        } else {
            return "";
        }
    }

    static function filteruri($str) {
        $str = mb_strtolower($str, 'UTF-8');
        $uml = array ("ä" => "ae", "ö" => "oe", "ü" => "ue", "ß" => "ss");
        $str = str_replace(array_keys($uml), array_values($uml), $str);
        $str = preg_replace('![^0-9a-z\s\-]!', '', $str);
        $str = str_replace(" ", "-", $str);
        while (strpos(" ".$str, "--") > 0) {
             $str = str_replace("--", "-", $str);
        }   
        return $str;
    }
    
}

?>