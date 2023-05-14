<?php
function shorteng_bookcode($book=""){#bookcode
    //this does way to much checking for such a simple task. but when used wrong ...   
    global $debug_flag;
    include_once __DIR__ . "/db_call.php";

    if (in_array(strtolower($book), array_map('strtolower',array("Gen", "Exod", "Lev", "Num", "Deut", "Josh", "Judg", "Ruth", "1Sam", "2Sam", "1Kgs", "2Kgs", "1Chr", "2Chr", "Ezra", "Neh", "Esth", "Job", "Ps", "Prov", "Eccl", "Song", "Isa", "Jer", "Lam", "Ezek", "Dan", "Hos", "Joel", "Amos", "Obad", "Jonah", "Mic", "Nah", "Hab", "Zeph", "Hag", "Zech", "Mal") ))) {
        if (ctype_alpha(substr($book, -1)))
        {
            if ($debug_flag) {echo PHP_EOL."<p debug='fun shorteng_bookcode:". $book ."'></p>";}
            $row = db_call("booklookup",'select book from booklookup WHERE shortbook = "'. $book. '"');
            if (isset($row[0]['book'])) {return $row[0]['book'];} else {
                if ($debug_flag) {echo PHP_EOL."<p debug= 'shorteng_bookcode error:"; print_r($book);  echo "'></p>";}
                return 0;}
        } else {
            if (strlen($book)<3)
            { if ($debug_flag) {echo PHP_EOL."<p debug='fun shorteng_bookcode called no value'></p>";}
            } else {
                if ($debug_flag) {echo PHP_EOL."<p debug='fun shorteng_bookcode called not alpha value'".$book."></p>";}}
            return $book;
        }
    } else {if ($debug_flag) {echo PHP_EOL."<p debug='fun shorteng_bookcode called not in set'".$book."></p>";}}
 }

function tnk($part){
    // 1-Torah 2-Nivim(2-NivimRishonom 3-NivimAchronim 4-Treasar) 5-Ktubim(6-Migilit 7-Tehilim 8-EzraNechmiaDaniel)
    switch($part){
    case 1: $section="Torah"; break;
    case 2: $section="Nivim NivimRishonom"; break;
    case 3: $section="Nivim NivimAchronim"; break;
    case 4: $section="Nivim Treasar"; break;
    case 5: $section="Ktubim";  break;
    case 6: $section="Ktubim Migilit";  break;
    case 7: $section="Ktubim Tehilim";  break;
    case 8: $section="Ktubim EzraNechmiaDaniel";  break;
    default: $section="";
    }
    return $section;
}


//gets  key checked via chk_key.php returns $text ($book,$chap,$verse)
function show_book($bookkey,$fn=1){#bookname
    global $debug_flag;
        include_once __DIR__ . "/db_call.php";
     /*
+----+-----------+-------------+
| Fn | Field     | Type        |
+----+-----------+-------------+
| *  | book      | int(11)     |
| 0  | fullbook  | varchar(12) |
| 1  | shortbook | varchar(6)  |
| 2  | hebbook   | varchar(13) |
| 3  | tnk       | tinyint(4)  |
| 4  | sederbook | varchar(13) |
+----+-----------+-------------+
  */

        if (($bookkey >= 1) && ($fn <5)) {
            if ($debug_flag) {echo PHP_EOL."<p debug='fun show_book:". $bookkey ."'></p>";}
            switch ($fn){
            case 0: $field="fullbook";
                $row =  db_call("booklookup",'select '.$field.' from booklookup WHERE book = "'. $bookkey. '"');
                $answer = $row[0]['fullbook'];
                break;
            case 1: $field="shortbook";
                $row =  db_call("booklookup",'select '.$field.' from booklookup WHERE book = "'. $bookkey. '"');
                $answer = $row[0]['shortbook'];
                break;
            case 2: $field="hebbook";
                $row =  db_call("booklookup", 'select '.$field.' from booklookup WHERE book = "'. $bookkey. '"');
                $answer = $row[0]['hebbook'];
                break;
            case 3: $field="tnk";
                $row =  db_call("booklookup", 'select '.$field.' from booklookup WHERE book = "'. $bookkey. '"');
                $answer = $row[0]['tnk'];
                break;
            case 4: $field="sederbook";
                $row =  db_call("booklookup",'select '.$field.' from booklookup WHERE book = "'. $bookkey. '"');
                $answer = $row[0]['sederbook'];
                break;
            default:  $field="*";
                $row =  db_call("booklookup", 'select '.$field.' from booklookup WHERE book = "'. $bookkey. '"');
                $answer = $row[0];
                break; 
            }
            if ($debug_flag) {echo "<p debug='show_book bookkey called:";  print_r(array($bookkey,$fn,$row));  echo "'></p>";}
            return $answer;
        } else  return 0;
}

