<?php
//$debug_flag=false;
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

include_once __DIR__ . "/hebrewize.php";

function show_word($key = 0,$word = 0,$comment_list=all_comments,$sqlwhereqwery=''){
    //    echo "show_word ".$key." ".$word." ".$sqlwhereqwery.;
global $debug_flag;
include_once __DIR__ . "/db_call.php";

    /*
describe words_full;
+--------------+----------+------+-----+---------------------+
| Field        | Type     | Null | Key | Default             |
+--------------+----------+------+-----+---------------------+
| id           | int(11)  | NO   | PRI | NULL                |
| keyvalue     | int(11)  | NO   |     | 0                   |
| book         | int(11)  | NO   |     | 0                   |
| ch           | int(11)  | NO   |     | 0                   |
| vr           | int(11)  | NO   |     | 0                   |
| wordnumber   | int(11)  | NO   |     | 0                   |
| counter      | int(11)  | NO   |     | 0                   |
| word_ktiv    | text     | NO   |     | ''                  |
| word_kri     | text     | NO   |     | ''                  |
| word_havarot | text     | NO   |     | ''                  |
| translit     | text     | NO   |     | ''                  |
| word_vowels  | text     | NO   |     | ''                  |
| what         | text     | NO   |     | ''                  |
| reason       | int(11)  | NO   |     | 0                   |
| last_updated | datetime | NO   |     | current_timestamp() |
+--------------+----------+------+-----+---------------------+
 */

$multi = ($word < 0) ? $sqlwhereqwery : '';
$more =  ($word > 0) ? " AND wordnumber = ".$word : '';
$keystring = ($key > 0) ? " keyvalue = ". $key : '';

if (!($comment_list == all_comments))
{
    if (empty($comment_list)) {$limitcomment='';}
    else
        switch (count($comment_list)){
        case 0: $limitcomment=''; break;
        case 1: $limitcomment=" and reason = ".$comment_list[0]; break;
        default: $limitcomment=" and reason in (".implode (",", $comment_list).")";
        }
} else $limitcomment='';
if (strlen($keystring. $more. $limitcomment. $multi) > 0){
    $query = "SELECT * FROM words_full WHERE ". $keystring. $more. $limitcomment. $multi;
    if ($debug_flag) echo PHP_EOL."<p debug= 'show_word query=:".$query."'></p>";
    
    $data = db_call("words_full",$query);
    return $data;
} else return array();
}

function vfix($verse){
    $gi=0;
    for($index=count($verse)-1;$index>=0;$index--){
        if ($verse[$index]['counter']>0){
            $verse[$index]['counter']=$gi; 
            $gi++;
        } else {
            if ($gi>0) 
            {
                //echo 'fixing '.$verse[$index]['word_ktiv']." ".$verse[$index]['counter']." ".$verse[$index]['reason'].PHP_EOL;
            }
            $verse[$index]['counter']=$gi; $gi=0;
        }
        //echo 'now '.$verse[$index]['word_ktiv']." ".$verse[$index]['counter']." ".$verse[$index]['reason'].PHP_EOL;
    }
     return $verse;
}




function verse_get($key=0,$book_code=0, $chapter_start=0, $chapter_end=0, $verse_start=0, $verse_end=0){
    // gets either key or cit start - end
    global $debug_flag;
    $verse=array();
    if ($debug_flag) {echo PHP_EOL."<p debug= 'verse_get:";
        
        echo json_encode(array($key,$book_code, $chapter_start, $chapter_end, $verse_start, $verse_end),JSON_UNESCAPED_UNICODE);
        echo "'></p>";}
    if ($key > 0)
    { if ($debug_flag){ echo PHP_EOL."<p debug= 'key ".$key."'></p>";}
         $verse = array_merge($verse, show_word($key));
    } else {
        if ($debug_flag){ echo PHP_EOL."<p debug= 'cit "."'></p>";}
        $sqlstring = '(book = '. $book_code. ') ';
        if ($chapter_start < 200){
            if ($chapter_start == $chapter_end) {
                if ($verse_start== $verse_end) {
                    if ($verse_start < 200)
                    {
                        if ($debug_flag){ echo PHP_EOL."<p debug= 'Chapter pair is equal and Verse pair is equal"."'></p>";}
                        $sqlstring .= 'and (ch = '. $chapter_start. ') and (vr = '. $verse_start.')';
                        if ($debug_flag){ echo PHP_EOL."<p debug= '". $sqlstring."'></p>";}
                        $verse = array_merge($verse,show_word(0,-1,all_comments,$sqlstring));
                    } else {
                         if ($debug_flag){ echo PHP_EOL."<p debug= 'Chapter only"."'></p>";}
                         $sqlstring .= 'and (ch = '. $chapter_start. ')';
                         $verse = array_merge($verse,show_word(0,-1,all_comments,$sqlstring));
                    }
                } elseif ($verse_start> $verse_end) {
                    if ($debug_flag){ echo PHP_EOL."<p debug= 'Chapter pair is equal and Verse pair is larger"."'></p>";}                   
                } else {
                    if ($debug_flag){ echo PHP_EOL."<p debug= 'Chapter pair is equal and Verse pair is smaller"."'></p>";}
                    $sqlstring .= 'and (ch = '. $chapter_start. ') and (vr  between '. $verse_start. ' and '.  $verse_end . ')';
                    if ($debug_flag){ echo PHP_EOL."<p debug= '". $sqlstring."'></p>";}
                    $verse = array_merge($verse,show_word(0,-1,all_comments,$sqlstring));
                }
            } elseif ($chapter_start > $chapter_end) {
                if ($verse_start== $verse_end) {
                    if ($debug_flag){ echo PHP_EOL."<p debug= 'Chapter pair is larger and Verse pair is equal"."'></p>";}        
                } elseif ($verse_start> $verse_end) {
                    if ($debug_flag){ echo PHP_EOL."<p debug= 'Chapter pair is larger and Verse pair is larger"."'></p>";}           
                } else {
                    if ($debug_flag){ echo PHP_EOL."<p debug= 'Chapter pair is larger and Verse pair is smaller"."'></p>";}           
                }
            } else {
                if ($verse_start== $verse_end) {
                    if ($debug_flag){ echo PHP_EOL."<p debug= 'Chapter pair is smaller and Verse pair is equal"."'></p>";}
                    $sqlstring .= 'and (ch = '. $chapter_start.  ') and (vr >= '.$verse_start .')';
                    if ($debug_flag){ echo PHP_EOL."<p debug= '". $sqlstring."'></p>";}
                    $verse = array_merge($verse,show_word(0,-1,all_comments,$sqlstring));
                    $verse = array_merge($verse,verse_get(0,$book_code,($chapter_start+1), $chapter_end, 1, $verse_end));
                } elseif ($verse_start> $verse_end) {
                    if ($debug_flag){ echo PHP_EOL."<p debug= 'Chapter pair is smaller and Verse pair is larger"."'></p>";}
                    for ($chapter=$chapter_start; $chapter<=$chapter_end; $chapter++){
                        $v1=1; $v2=199;
                        if ($chapter==$chapter_start){$v1=$verse_start;}
                        if ($chapter==$chapter_end){$v2=$verse_end;}
                        $sqlstring = '(book = '. $book_code. ') and (ch = '. $chapter. ') and (vr between '. $v1. ' and '.  $v2. ')';
                        $verse = array_merge($verse,show_word(0,-1,all_comments,$sqlstring));
                    }
                } else {
                    if ($debug_flag){ echo PHP_EOL."<p debug= 'Chapter pair is smaller and Verse pair is smaller"."'></p>";}
                    $sqlstring .= 'and (ch = '. $chapter_start.  ') and (vr >= '.$verse_start .')';
                    if ($debug_flag){ echo PHP_EOL."<p debug= '". $sqlstring."'></p>";}
                    $verse = array_merge($verse,show_word(0,-1,all_comments,$sqlstring));
                    $verse = array_merge($verse,verse_get(0,$book_code,($chapter_start+1), $chapter_end, 1, $verse_end));
                }
            }
      } else {
            if ($debug_flag){ echo PHP_EOL."<p debug= 'Book only"."'></p>";}
            if ($debug_flag){ echo PHP_EOL."<p debug= '". $sqlstring."'></p>";}
            $verse = array_merge($verse,show_word(0,-1,all_comments,$sqlstring));
        }
    }
    if (!isset($verse)) return array();
    else {return vfix($verse);}
}       



function vshow($verse){
    for($index=0;$index<count($verse);$index++){
        if (($verse[$index]['counter']>0) || ($verse[$index]['reason']>0))
        {
            if (!$footnote) {echo 'mesora '; $footnote=true;}
            echo $verse[$index]['word_ktiv']." ".$verse[$index]['counter']." ".$verse[$index]['reason'].PHP_EOL;
            if ($verse[$index]['counter']==0) {echo 'end'.PHP_EOL; $footnote=false;}
        }
    }
}


function vprint($verse){
    include_once __DIR__ . "/fix_peh_samach.php";
    $decyphered_verse="";
    $footnote=false; $foot="";
    $krifoot="";$ktivhead="";$kri_ktiv=false;
    for($index=0;$index<count($verse);$index++)
    {
        $word=$verse[$index];
        if (($word['counter']>0) || ($word['reason']>0))
        {
            switch ($word['reason']){
            case 0:
                $note= fix_peh_samach($word['word_ktiv']);
                break;
            case 1:
                $krifoot="<sup> ".$word['word_kri']." </sup>";
                $ktivhead="<sub> ".fix_peh_samach($word['word_ktiv'])." </sub>";
                $kri_ktiv=true;
                break;
            default:
                if ($footnote) $foot.=",";
                $footnote=true;
                $foot.=$word['what'];              
                break;
            }
             if ($word['counter']==0) 
             {  if ($footnote) $decyphered_verse.="<a class='footnote'>";
                if ($kri_ktiv) $decyphered_verse.=$ktivhead." "; else $decyphered_verse.=$note." ";
                if ($footnote) $decyphered_verse.="<span>".$foot."</span>";
                if ($kri_ktiv) $decyphered_verse.=$krifoot;
                if ($footnote) $decyphered_verse.='</a>';
                $footnote=false; $foot=""; $note="";
                $krifoot="";$ktivhead="";$kri_ktiv=false;
             }
        }
        else
        { 
           $decyphered_verse.=fix_peh_samach($word['word_ktiv'])." ";
        }
    }
    return $decyphered_verse;
}
