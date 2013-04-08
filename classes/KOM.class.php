<?php

class KOM {

    static $dblink;
    static $mainDB;
    static $pagetitle;
    static $site_url;

    static $pages;
    static $active;
    static $scripts;
    static $styles;
    static $menus;
    
    static function registerPage($page) {
        $name = $page['name'];
        KOM::$pages[$name]  = $page;
    }
    static function registerPages($pages) {
        if (is_array($pages)) {
            foreach ($pages as $value) {
                $name = $value['name'];
                KOM::$pages[$name] = $value;
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
            if ($value['showonlywhenactive'] == true) continue;
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
            
            
            if (is_array(KOM::$pages) && in_array($page, array_keys(KOM::$pages))) {
                $url = $page."/";
            } else {
                switch ($page) {
                    case "category":
                        $url = "liste/";
                        if (isset($array['cat'])) {
                            $url .= KOM::filteruri(KOM::$mainDB->getCategory($array['cat'])->getName())."/";
                        }
                    break;
                    case "single":
                        $url = "detail/".$array['issueid'];
                    break;
                    case "custompage":
                        if (isset($array['custompageid'])) {
                            $url = "seite/";
                            $url .= $array['custompageid']."/";
                        }
                    break;
                    case "home":
                        $url = "";
                    break;
                }
            }
            return SITE_URL."/".$url;
    
    }
    
    static function modrewrite($uri) {
        
        
        foreach (KOM::$mainDB->getCategories() as $val) {
            $catarray[KOM::filteruri($val->getName())] = $val->getID();
        }
        foreach (KOM::$dblink->Select("custompages") as $val) {
            $cparray[$val->name] = $val->id;
        }
        
        $active['page'] = "home";

        $urisplit = explode("/", $uri);
        
        if ($urisplit[1] == "liste") {
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
        if ($urisplit[1] == "detail") {
            unset($active);
            $active['page'] = "single";
            $active['issueid'] = $urisplit[2];
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
        $str = strtolower($str);
        $uml = array ("ä" => "ae", "ö" => "oe", "ü" => "ue", "ß" => "ss");
        $str = str_replace(array_keys($uml), array_values($uml), $str);
        $str = preg_replace('![^a-z\s\-]!', '', $str);
        $str = str_replace(" ", "-", $str);
        while (strpos(" ".$str, "--") > 0) {
             $str = str_replace("--", "-", $str);
        }   
        return $str;
    }
    
}

?>