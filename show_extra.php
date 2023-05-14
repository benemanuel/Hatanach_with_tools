<?php
function show_extra($key,$raw = 1,$table = 'never empty', $title_string = '<p dir="ltr" lang="en">Extra:</p>',$lookupkey='keyvalue'){#comments/
    global $debug_flag;
    include_once __DIR__ . "/db_call.php";

    if (!defined('html')) define('html',1);
    if (!defined('text_only')) define('text_only',0);
    //echo "<p debug='fun show_extra:". $key ."'></p>";
    if ($key > 1){
        $query = 'SELECT * FROM ' . $table . ' WHERE '.$lookupkey.' = ' . $key;
        if ($debug_flag) echo PHP_EOL."<p debug= 'show_extra '".$table.' query=:'.$query."'></p>";
        $value = db_call($table,$query);
        $answer="";
        if ((isset($value)) && (count($value)>0))
        {
            $answer = $title_string;
            foreach ($value as $index => $note) { $answer.=" ". $note['verse']."<br>";}
            if (strlen($answer)>0) $answer.="</p>";
            return $answer;
        }
        else  return "";
    } else return "";
}
