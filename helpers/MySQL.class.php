<?php

class MySQL {

	private $host;
	private $user;
	private $pass;
	private $database;
	
	private $sql;
    
    function __construct($host, $user, $pass, $database) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;
    }
	
	public function connect() {
		$this->sql = mysql_connect($this->host, $this->user, $this->pass);
		mysql_select_db($this->database, $this->sql);
		$query = "SET NAMES 'utf8'";
		mysql_query($query, $this->sql);
	}
	public function Select($table, $what = "*", $misc = "") {
		$query = "SELECT $what FROM $table ".$misc;
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
            if (!is_numeric($val)) {
                $insar2["`".$key."`"] = "'".$val."'";
            } else {
                $insar2["`".$key."`"] = $val;
            }
        }
		$query = "INSERT INTO ".$table." (";
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
            if (!is_numeric($val)) {
                $updar2["`".$key."`"] = "'".$val."'";
            } else {
                $updar2["`".$key."`"] = $val;
            }
        }
		$query = "UPDATE ".$table." SET";
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
		$query = "DELETE FROM $table ".$misc;
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