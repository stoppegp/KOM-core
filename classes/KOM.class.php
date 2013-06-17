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
            $ret0['submenu'] = $value['submenu'];
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