<?php 
function getQueriesFromFile($file) 
{ 

    $file = str_replace("\r\n", "\n", $file); # windows -> linux
    $file = str_replace("\r", "\n", $file); # mac -> linux
    
    $file = explode("\n", $file);
    
    //(remove) those lines, beginning with an sql comment token 
    $file = array_filter($file, 
                         create_function('$line', 
                                         'return strpos(ltrim($line), "--") !== 0;')); 
    // this is a list of SQL commands, which are allowed to follow a semicolon 
    $keywords = array('ALTER', 'CREATE', 'DELETE', 'DROP', 'INSERT', 'REPLACE', 'SELECT', 'SET', 
                      'TRUNCATE', 'UPDATE', 'USE'); 
    // create the regular expression 
    $regexp = sprintf('/\s*;\s*(?=(%s)\b)/s', implode('|', $keywords)); 
    // split there 
    $splitter = preg_split($regexp, implode("\r\n", $file)); 
    // remove trailing semicolon or whitespaces 
    $splitter = array_map(create_function('$line', 
                                          'return preg_replace("/[\s;]*$/", "", $line);'), 
                          $splitter); 
    // remove empty lines 
    return array_filter($splitter, create_function('$line', 'return !empty($line);')); 
} 
?>

<h1>KOM Install</h1>

<?php


if (isset($_POST['install']['do'])) {
    $install = $_POST['install'];
    $datei = fopen("../config.php", "w");
    
    $configtext = <<< CONFIG
    <?php
        define( 'DB_HOST',      "{$install['dbhost']}");
        define( 'DB_USER',      "{$install['dbuser']}");
        define( 'DB_PASSWORD',  "{$install['dbpassword']}");
        define( 'DB_DBNAME',    "{$install['dbname']}");
        define( 'DB_PREFIX',    "{$install['dbprefix']}");

        define(  'SITE_URL',    "{$install['url']}");


        KOM::\$pagenames = array(

            "category"  =>  "",
            "single"    =>  "",
            "report"    =>  "fehler-melden"


        );

    ?>
CONFIG;
    fwrite($datei, $configtext);
    fclose($datei);
    
        $sql = mysql_connect($install['dbhost'], $install['dbuser'], $install['dbpassword']);
		mysql_select_db($install['dbname'], $sql);
        
        ob_start();
        
        include('sql.inc.php');
        
        $query = ob_get_contents();
        
        ob_end_clean();
        
        $queries = getQueriesFromFile($query);
        foreach ($queries as $value) {
            mysql_query($value, $sql);
        }
    
        echo mysql_error();
        
        echo "<textarea>".$query."</textarea>";
}

    

?>


<form method="post">
<table>
    <tr>
        <td>Seitentitel:</td>
        <td><input type="text" name="install[pagetitle]" /></td>
    </tr>
    <tr>
        <td>URL:</td>
        <td><input type="text" name="install[url]" /></td>
    </tr>
    <tr>
        <td>Startdatum:</td>
        <td><input type="text" name="install[startdatum]" /></td>
    </tr>
    <tr>
        <td>Enddatum:</td>
        <td><input type="text" name="install[enddatum]" /></td>
    </tr>
</table>

<table>
    <tr>
        <td>Datenbank-Benutzer:</td>
        <td><input type="text" name="install[dbuser]" /></td>
    </tr>
    <tr>
        <td>Datenbank-Kennwort:</td>
        <td><input type="text" name="install[dbpassword]" /></td>
    </tr>
    <tr>
        <td>Datenbank-Host:</td>
        <td><input type="text" name="install[dbhost]" /></td>
    </tr>
    <tr>
        <td>Datenbank-Prefix:</td>
        <td><input type="text" name="install[dbprefix]" /></td>
    </tr>
    <tr>
        <td>Datenbank:</td>
        <td><input type="text" name="install[dbname]" /></td>
    </tr>
</table>
<input type="hidden" name="install[do]" value="1" />
<input type="submit" />
</form>
