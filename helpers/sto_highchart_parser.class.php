<?php
/*
sto-highchart-parser
simple parser for highcharts

version: 20130408-01

author: Martin Stoppler
licence: dowhateveryouwant

*/


class sto_highchart_parser {
    
    private $id;
    public $options;
    public $activelinks = false;
    
    function __construct($id) {
        $this->id = $id;
        $this->options = array("chart" => array("renderTo" => $id));
    }
    
    public function activateLinks($what = "point", $url = false) {
        switch ($what) {
            case "series":
                 $this->options['plotOptions']['series']['events']['click'] = "function(event) {
                            location.href = this.options.url;
                        }";
                break;
            case "custom":
                $this->options['plotOptions']['series']['point']['events']['click'] = "function() {
                                location.href = \"".$url."\";
                            }";
            break;
            case "point":
            default:
                $this->options['plotOptions']['series']['point']['events']['click'] = "function() {
                                location.href = this.options.url;
                            }";
        }
        $this->options['plotOptions']['series']['cursor'] = "pointer";
    }
    
    public function exploderec($array) {
		$ret = "";
        foreach ($array as $key => $val) {
            if (is_numeric($val) || strpos(" ".$val, "function(") > 0) {
                $val0 = $val;
            } elseif (is_bool($val)) {
                if ($val) {
                    $val0 = "true";
                } else {
                    $val0 = " false";
                }
            } else {
                $val0 = '"'.$val.'"';
            }
        
            if (!is_array($val)) {
                if (is_numeric($key)) {
                    $ret .= $val0.','."\n";
                } else {
                    $ret .= '"'.$key.'":'.$val0.','."\n";
                }
            } else {
                if (!$this->isAssoc($val)) {
                    if (!$this->isAssoc($array)) {
                        $ret .= '['.$this->exploderec($val).'],';
                    } else {
                        $ret .= '"'.$key.'": ['.$this->exploderec($val).'],';
                    }
                } else {
                    if (!$this->isAssoc($array)) {
                        $ret .= '{'.$this->exploderec($val).'},';
                    } else {
                        $ret .= '"'.$key.'": {'.$this->exploderec($val).'},';
                    }
                }
            }
        }
        return $ret;
    }
    
    private function isAssoc($arr)
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
    
    public function render() {
        $ret = "$(function () {";
            $ret .= "$('#".$this->id."').highcharts({";
            $ret .= $this->exploderec($this->options);
            $ret .= "});";
        $ret .= "});";
        return $ret;
    }

}
?>
