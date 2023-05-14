<?php
include_once __DIR__ . "/gematria.php";
include_once __DIR__ . "/booklookup.php";

function hebrewize($book_code,  $chapter_number, $verse_number, $seder=false){
    global $debug_flag;
    if ($debug_flag) {echo PHP_EOL."<p debug='heb= ".json_encode(array($book_code,  $chapter_number, $verse_number),JSON_UNESCAPED_UNICODE)."'></p>";}

    $perekname = "פרק";
    $sedername = "סדר";
    $chaptername = "";
    
    if ($book_code > 0){
        if ($seder) {
            $hebrewbookname = 3;
            $chaptername = $sedername;
        } else {
            $hebrewbookname = 2;
            $chaptername = $perekname;
        }
        $hebname = show_book($book_code,$hebrewbookname);
        if ($verse_number > 0) {
            $value = $hebname." ".$chaptername  ." ". number2hebrew($chapter_number). " פסוק ". number2hebrew($verse_number);
        } else {
            if ($chapter_number > 0)
            { $value = $hebname." ".  "כל ". $chaptername." ". number2hebrew($chapter_number);}
            else $value = $hebname." ".  "כל הספר";
        }
    } else {$hebname="";
        if ($verse_number > 0) {
            $value = $hebname.  $chaptername." ". number2hebrew($chapter_number). " פסוק ". number2hebrew($verse_number);
        } else { if ($chapter_number > 0)
            { $value = $hebname.  "כל ".$chaptername." ". number2hebrew($chapter_number);}
             else $value = $hebname." ".  "רפסה לכ";
       }
    }
return $value;
}

