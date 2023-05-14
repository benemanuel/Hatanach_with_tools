<?php
if (!defined('id')) define('id',0);
if (!defined('keyvalue')) define('keyvalue',1);
if (!defined('book')) define('book',2);
if (!defined('ch')) define('ch',3);
if (!defined('vr')) define('vr',4);
if (!defined('wordnumber')) define('wordnumber',5);
if (!defined('counter')) define('counter',6);
if (!defined('word_ktiv')) define('word_ktiv',7);
if (!defined('word_kri')) define('word_kri',8);
if (!defined('word_havarot')) define('word_havarot',9);
if (!defined('translit')) define('translit',10);
if (!defined('word_vowels')) define('word_vowels',11);
if (!defined('what')) define('what',12);
if (!defined('reason')) define('reason',13);
                            
if (!defined('all_comments')) define('all_comments',array(0,1,2,3,4,5,6,7,8,9,10,11,12,13));

if (!defined('home_url')) define('home_url',"https://hatanach.geulah.org.il/verse/");
if (!defined('output_1')) define('output_1','<a target = ' . "'_self'" . ' href="');
if (!defined('output_2')) define('output_2','"/>');
if (!defined('output_3')) define('output_3',"</a>");

function sv($key=0,$book_code=0, $chapter_number=0, $chapter_end=0, $verse_number=0, $verse_end=0){
global $debug_flag;
include_once __DIR__ . "/fix_peh_samach.php";
include_once __DIR__ . "/verse_get.php";
    if ($debug_flag) echo "<p debug='sv:".$key.PHP_EOL."'></p>";
    $verse=verse_get($key,$book_code, $chapter_number, $chapter_end, $verse_number, $verse_end);
    $dv="";
    //echo "loop verse".PHP_EOL;
	foreach ($verse as $index => $word) {
        if ($word['reason']==0)
        {
            echo "[".$index."]". fix_peh_samach($word['word_ktiv'])."<br>".PHP_EOL;
            $dv.=fix_peh_samach($word['word_ktiv'])." ";
        }
    }
    return $dv;
}

function acv($osis){ //all_citation_verse($osis) {#array($hebcit,$fulltext,$url_output,$engcit);
    global $debug_flag;
    global $highlight;
    include_once __DIR__ . "/verse_get.php";
    include_once __DIR__ . "/booklookup.php";

    if (!defined('home_url')) define('home_url',"https://hatanach.geulah.org.il/verse/");
    if (!defined('output_1')) define('output_1','<a target = ' . "'_self'" . ' href="');
    if (!defined('output_2')) define('output_2','"/>');
    if (!defined('output_3')) define('output_3',"</a>");
    if (!defined('bcv')) define('bcv',3);
    if (!defined('bc')) define('bc',2);
    if (!defined('book_only')) define('book_only',1);

    $m_hebcit = "";
    $m_pasuk = array();
    $m_url = "";
    $m_engcit = "";
    
    if (strpos($osis, "EEE") > 0)
    {
        if ($debug_flag) {echo PHP_EOL."<p debug='haserror"; print_r($status.$osis);  echo "'></p>";}
        return [0,'<p dir="ltr" lang="en" class="error-text-area">Error check syntax ',
                "<a target = '_blank' href='https://hatanach.geulah.org.il/syntax.html'/> Citation Syntax <br></a></p>",0];
    } else {
        $parts = explode(",", $osis);
        foreach ($parts as $p => $part) {
            if ($debug_flag) {echo PHP_EOL."<p debug='$p"; print_r($part);  echo "'></p>";}
            if (strpos($part, "-") !== false) {
                //range begin
                $range = explode("-", $part);
                if ($debug_flag) {echo PHP_EOL."<p debug='range"; print_r($range);  echo "'></p>";}
                //definition of range has two parts show from start "-" finish
                if (count($range) == 2) { //a range that has 2 values a start and end
                    list($startbook, $startchapter, $startverse) = explode(".", $range[0]);
                    list($endbook, $endchapter, $endverse) = explode(".", $range[1]);
                    if ($startbook <> $endbook) {
                        return [0,"range unknown diffrent books","",0];
                    } else {
                        $streamverse = verse_get(0,shorteng_bookcode($startbook), $startchapter, $endchapter, $startverse, $endverse);
                        $hebcit='(' . hebrewize(shorteng_bookcode($startbook), $startchapter, $startverse) ."-". hebrewize(shorteng_bookcode($startbook), $endchapter, $endverse). ')';
                        $engcit= '(' . $startbook. $startchapter.":". $startverse ."-". $endbook. $endchapter.":". $endverse. ')';
                        $url_output = home_url . '?verse=' . $startbook. $startchapter.":". $startverse ."-". $endbook. $endchapter.":". $endverse;
                        $url = '<h2><p dir="rtl" lang="he" class="source-text-area">' . output_1 . $url_output . output_2 . $hebcit . output_3 . "</p></h2>";
                    }
                }
                $m_hebcit .= $hebcit;
                $m_pasuk=array_merge($m_pasuk, $streamverse);
                $m_url .= $url;
                $m_engcit .= $engcit;
                //range end
            } else {
                $chapter_end = 200;
                $verse_end = 200;
                $pieces = explode(".", $part);
                switch (count($pieces)) {
                case bcv:
                    list($book, $chapter_number, $verse_number) = $pieces;
                    $chapter_end = $chapter_number;
                    $verse_end = $verse_number;
                    $book_code = shorteng_bookcode($book);
                    break;
                case bc:
                    list($book, $chapter_number) = $pieces;
                    $chapter_end = $chapter_number;
                    $verse_number = 200;
                    $book_code = shorteng_bookcode($book);
                    break;
                case book_only:
                    list($book) = $pieces;
                    $verse_number = 1;
                    $chapter_number = 200;
                    $book_code = shorteng_bookcode($book);
                    break;
                default:
                    return [0,"Error: ".count($pieces),json_encode($pieces,JSON_UNESCAPED_UNICODE),0];
                }
                if ($debug_flag) {echo PHP_EOL."<p debug='clear"; print_r($part." <".count($pieces)."> ".$chapter_number.":".$verse_number);  echo "'></p>";}
                //heading
                $hebrew_heading="";
                if ($verse_number == 200) {
                    // Load entire chapter
                    $hebrew_heading=hebrewize($book_code, $chapter_number, 0);
                    $engcit = "(" . $book . $chapter_number . ")";
                    $hebcit = '(' . hebrewize($book_code, $chapter_number, 0) . ')';
                    $url_output = home_url . '?verse=' . $book . $chapter_number;// . '&highlight=' . $highlight;
                } elseif ($chapter_number == 200) {
                    // Load entire book
                    $hebrew_heading=hebrewize($book_code, 0, 0);
                    $engcit = "(" . $book . ")";
                    $hebcit = '(' . hebrewize($book_code, 0, 0) . ')';
                    $url_output = home_url . '?verse=' . $book;// '&highlight=' . $highlight;
                } else {
                    // Load specific verse
                    // Load verse $verse of chapter $chapter
                    $hebrew_heading=hebrewize($book_code, $chapter_number, $verse_number);
                    $engcit = "(" . $book . $chapter_number . ":". $verse_number.")";
                    $hebcit = '(' . hebrewize($book_code, $chapter_number, $verse_number) . ')';
                    $url_output = home_url . '?verse=' . $book . $chapter_number . ":". $verse_number;//'&highlight=' . $highlight;
                }
                $fulltext = verse_get(0,$book_code, $chapter_number, $chapter_end, $verse_number, $verse_end);
                $m_hebcit .= $hebcit;
                $m_pasuk=array_merge($m_pasuk, $fulltext);
                $m_url .= $url_output;
                $m_engcit .= $engcit;
            }
        }
        return array(
            $m_hebcit,
            $m_pasuk,
            $m_url,
            $m_engcit
        );
    }
}

