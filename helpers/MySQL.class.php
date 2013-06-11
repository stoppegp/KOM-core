<?php

class MySQL {

	private $host;
	private $user;
	private $pass;
	private $database;
    private $prefix;
	
	private $sql;
    
    function __construct($host, $user, $pass, $database, $prefix = "") {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;
        $this->prefix = $prefix;
    }
	
	public function connect() {
		$this->sql = mysql_connect($this->host, $this->user, $this->pass);
		mysql_select_db($this->database, $this->sql);
		$query = "SET NAMES 'utf8'";
		mysql_query($query, $this->sql);
	}
    
    private function trans($value, $like = false) {
        if (is_numeric($value)) {
            return $value;
        } else {
            if ($like) {
                return "'".addcslashes(mysql_real_escape_string($value, $this->sql), "%_")."'";
            } else {
                return "'".mysql_real_escape_string($value, $this->sql)."'";
            }
        }
    }
    
	public function Select($table, $what = "*", $misc = "") {
		
        $query = "SELECT $what FROM ".$this->prefix.$table." ".$misc;
		$sql = mysql_query($query, $this->sql);
		if (mysql_errno()) {
			throw new DBError(mysql_error()."<br />".$query);
			return false;
		} else {
			while ($ds = mysql_fetch_object($sql)) {
				$erg[] = $ds;
			}
			if (isset($erg)) {
				return $erg;
			}
		}
	}
	
	public function Insert($table, $insar) {
        foreach ($insar as $key => $val) {
            $insar2["`".$key."`"] = $this->trans($val);
        }
		$query = "INSERT INTO ".$this->prefix.$table." (";
		$query .= implode(", ", array_keys($insar2));
		$query .= ") VALUES (";
		$query .= implode(", ", $insar2);
		$query .= ")";
		mysql_query($query, $this->sql);
		if (mysql_errno()) {
			throw new DBError(mysql_error()."<br />".$query);
			return false;
		} else {
			return true;
		}
		//echo "<pre>".$query."</pre>";
		
	}
	
	public function Update($table, $updar, $misc) {
        foreach ($updar as $key => $val) {
            $updar2["`".$key."`"] = $this->trans($val);
        }
		$query = "UPDATE ".$this->prefix.$table." SET";
		foreach ($updar2 as $key2 => $val2) {
			$updar3[] = " ".$key2."=".$val2;
		}
		$query .= implode(",", $updar3);
		$query .= " ".$misc;
		mysql_query($query, $this->sql);
		if (mysql_errno()) {
			throw new DBError(mysql_error()."<br />".$query);
			return false;
		} else {
			return true;
		}
		//echo "<pre>".$query."</pre>";
		
	}
	
	public function Delete($table, $misc) {
		$query = "DELETE FROM ".$this->prefix.$table." ".$misc;
		mysql_query($query, $this->sql);
		if (mysql_errno()) {
			throw new DBError(mysql_error()."<br />".$query);
			return false;
		} else {
			return true;
		}
	}
}

?>