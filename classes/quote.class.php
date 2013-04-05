<?php

class Quote {


    private $type;
    private $text;
    private $source;
    private $url;
    private $page;
    private $linkDatabase;

   
	function __construct($type, $text, $source, $url, $page) {
        $this->type = $type;
        $this->text = $text;
        $this->source = $source;
        $this->url = $url;
        $this->page = $page;
        $this->linkDatabase = &$database;
	}
    
    
    
    /* Getter-Funktionen */
    
    public function getType() {
        return $this->type;
    }
    public function getText() {
        return $this->text;
    }
    public function getSource() {
        return $this->source;
    }
    public function getURL() {
        return $this->url;
    }
    public function getPage() {
        return $this->page;
    }
    
}

?>