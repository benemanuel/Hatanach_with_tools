<?php
global $key_call;
global $random_call;
global $cit_call;

//include_once __DIR__ . "/push_buttons.php";
include_once __DIR__ . "/publish_html.php";
include_once __DIR__ . "/show_extra.php";

include_once __DIR__ . "/verse_get.php";
include_once __DIR__ . "/convertor.php";
include_once __DIR__ . "/booklookup.php";

function key_like_call($key){
global $debug_flag;
global $text_only;

    include_once __DIR__ . "/publish_html.php";
    include_once __DIR__ . "/fix_peh_samach.php";

    if ($debug_flag) {echo "<p debug='key_call";  print_r($key);  echo "'></p>";}
    if (!defined('sefer')) define('sefer'," ספר:");
    if (!defined('perek')) define('perek'," פרק:");
    if (!defined('pasuk')) define('pasuk'," פסוק:");
    if (!defined('quote')) define('quote','"');
    if (!defined('html')) define('html',1);
    if (!defined('text_only')) define('text_only',0);

    $pasuk=vprint(verse_get($key));
    list($bk, $ch, $vr) = explode(".", convertor($key,"",true));

    $bk_code= shorteng_bookcode($bk);
    $fullbook = show_book($bk_code,0);
    $hebbook = show_book($bk_code,2);
    $hebcit =  sefer . $hebbook  . " " . perek . $ch . " " . pasuk . $vr;
    $engcit = $bk.$ch.":".$vr;
    // Remove everything in between the <span> tags, as well as the <span> tags themselves
    $cleanstring = preg_replace('/<span[^>]*>.*?<\/span>/', '', $pasuk);
    // Remove the <a> tag along with its brackets, and keep the text inside it
    $cleanstring = preg_replace('/<a[^>]*>(.*?)<\/a>/', '$1', $cleanstring);
    $cleanstring = fix_peh_samach($cleanstring,false);

    publish_html($key,$hebcit,$cleanstring,"",$engcit,$pasuk,false);

    if (!$text_only)
    {
        $result=show_extra($key,html,'editornotes','<p dir="rtl" lang="he" class="editornotes-text-area">הערות העורך:','keyvalue');
        echo $result;
        $result=show_extra($key,html,'hebrew','<p dir="rtl" lang="he" class="hebrew-text-area">תרגום ארמית לעברית:','id');
        echo $result;
        
        include_once __DIR__ . "/show_translit.php";
        $result=show_translit($cleanstring);
        $loop = $result[0];//this will always be 2 unless show_translit($cleanstring,0) is used, then it will be 1
        for ($x = 1; $x <= $loop; $x++) {
            echo $result[$x];
        }
    
        $home_eng_url="https://www.biblegateway.com/passage/?search=";
        $en_flag='<img title="English" src="files/en.png" alt="English" width="16" height="11" />';
        
        $version="NET"; $lang="en"; $flag=$en_flag;
        include_once __DIR__ . "/show_transilation.php";
        $en_url=show_transilation($key,$engcit, $lang, $version, $both_url_text);
        
        $fr_flag='<img title="français" src="files/fr.png" alt="French" width="16" height="11" />';
        $version="BDS"; $lang="fr"; $flag=$fr_flag;
        $fr_url=show_transilation($key,$engcit, $lang, $version, $both_url_text);
        
        $ru_flag='<img title="русски" src="files/ru.png" alt="Russian" width="16" height="11" />';
        $version="RUSV"; $lang="ru"; $flag=$ru_flag;
        $ru_url=show_transilation($key,$engcit, $lang, $version, $both_url_text);
    }
}

function print_details($key,$date=""){
    global $debug_flag;
    echo "<br><details>";
    if (!empty($date)) {
          echo "<date>";
          echo (is_numeric($date))?  date('l jS \of F Y h:i:s A',$date) : $date;
          echo "</date>";
    }
    if ($key>0) {echo url_create($key, "verse" );}

    if ($sedarim_citation)
    {
        include_once __DIR__ . "/show_sedarim.php";
        include_once __DIR__ . "/all_sedarim_verse.php";
        include_once __DIR__ . "/sedarim_verse.php";
        
        $sedar=show_sedarim($key);
        sedarim_verse($sedar);
    
        $sedar=show_fullsedarim($key);
        all_sedarim_verse($sedar, $key);
    }
    echo "</details>";
}


function citation_call($cit,$high=0){
    include_once __DIR__ . "/publish_html.php";
    include_once __DIR__ . "/fix_peh_samach.php";
    include_once __DIR__ . "/acv.php";
    include_once __DIR__ . "/publish_tweet.php";
    
    global $highlight;
    global $debug_flag;
    global $tweet_display;
    global $engraving_display;
    global $text_only;
    
    if ($debug_flag) {echo "<p debug='cit_call";  print_r($cit);  echo "'></p>";}
     $command_line =
    "cd  /var/www/hatanach/verse/script/ && node citapp.js -c " .
    " '" .
    $cit .
    "'  2>&1";
     
    $osis = exec($command_line, $out, $err);
    if (!strpos($osis, "EEE") > 0)
    {
        list($hebcit,$citarray,$url_output,$engcit)=acv($osis);
        $dv="";
        $o_vr=0;
        foreach ($citarray as $index => $word) {
            if (!($word['vr'] == $o_vr))
            {
                 if ($highlight) $dv.='</span>';
                 $dv.= " (".number2hebrew($word['vr']).")";
                 $o_vr = $word['vr'];
                 $highlight = $word['vr'] == $high;
                 if ($highlight) $dv.='<span class=source-text-highlighted-area>';
            }
            if ($word['reason']==0)
            {
                if ($index==0) $vr_start = $word['vr'];
                $dv.=" ".fix_peh_samach($word['word_ktiv'],false);
            }
        }
        if ($vr_start == $word['vr']) $vr_heb="(".number2hebrew($word['vr']).")";
        else $vr_heb="(".number2hebrew($vr_start)."-".number2hebrew($word['vr']).")";
        if (strpos($engcit,"(") === false) $cit=$engcit;
        else  $cit=str_replace(")(",",",substr($engcit, 1, -1));
        publish_html(0,$hebcit,$dv,$url_output,$engcit,url_create($cit,$vr_heb,$dv,$highlight));
        if ($tweet_display || $engraving_display) tweet_call($hebcit,$cit,$highlight);
    }
    return $osis;     
}

