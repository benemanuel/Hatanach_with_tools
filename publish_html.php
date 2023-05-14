<?php

function url_create($cit,$text,$in_p_text="",$highlight=false){
    if (!defined('output_1')) define('output_1','<a target = ' . "'_self'" . ' href="');
    if (!defined('output_2')) define('output_2','"/>');
    if (!defined('output_3')) define('output_3',"</a>");
    if (!defined('home_url')) define('home_url','https://hatanach.geulah.org.il/verse/');

        //    $bk . $ch . ':' . $vr, sefer . $hebbook  . " " . perek . $ch . " " . pasuk . $vr );
        //    $engcit = "(" . show_book($book) . $chapter_number . ":" . $verse_number . ")";
        //    $hebcit = '(' . hebrewize($book, $chapter_number, $verse_number) . ')';

        //$home_url='https://hatanach.geulah.org.il/verse/';
    if (ctype_digit($cit))
    {
        $url_output = home_url . '?key=' . $cit;
        //if ($highlight) $url_string = '<h2><p dir="rtl" lang="he" class="source-text-highlighted-area">';
        //else
        $url_string = '<h2><p dir="rtl" lang="he" class="source-text-area">';
        $url_string = $url_string . output_1 . $url_output . output_2 . $text. output_3 .$in_p_text . "</p></h2>";
    }
    else
    {
        $url_output = home_url . '?cit=' . $cit;
        //if ($highlight) $url_string = '<h2><p dir="rtl" lang="he" class="source-text-highlighted-area">';
        //else
        $url_string = '<h2><p dir="rtl" lang="he" class="source-text-area">';
        $url_string = $url_string . output_1 . $url_output . output_2 . $text. output_3 .$in_p_text . "</p></h2>";
    }
    return $url_string;
}


function publish_html($key=0,$hebcit,$dv,$url_output,$engcit,$pdv="",$highlight=false){
    include_once __DIR__ . "/push_buttons.php";
    include_once __DIR__ . "/cit_push_buttons.php";
    include_once __DIR__ . "/button_wrap.php";
    include_once __DIR__ . "/convertor.php";
    //    include_once __DIR__ . "/fix_peh_samach.php";
    //include_once __DIR__ . "/acv.php";

    global $buttons;
    global $push_buttons;
    global $debug_flag;
    global $text_only;
    global $block_format;

    if ($debug_flag) {
        echo PHP_EOL."<p debug='publish_html called:(key,hebcit,dv,highlight)";
        print_r(array($key,$hebcit,$dv,$highlight));
        //print_r($url_output);
        //print_r($pdv);
        echo "'></p>";}
    
        echo PHP_EOL."<div class='hidden'  style='display: none;'> publish_html called:(key,hebcit,dv,highlight,url_output,pdv)";
        print_r(array($key,$hebcit,$dv,$highlight,$url_output,$pdv));
        echo "</div>";

    if (!defined('sefer')) define('sefer'," ספר:");
    if (!defined('perek')) define('perek'," פרק:");
    if (!defined('pasuk')) define('pasuk'," פסוק:");
    if (!defined('quote')) define('quote','"');

    if (!defined('output_1')) define('output_1','<a target = ' . "'_self'" . ' href="');
    if (!defined('output_2')) define('output_2','"/>');
    if (!defined('output_3')) define('output_3',"</a>");
    //output_1='<a target = ' . "'_blank'" . ' href="';
    if (!$text_only)
    {
        if ($block_format){
            if ($highlight)
                echo '<br><h2><p dir="rtl" lang="he" class="source-text-highlighted-area">';
            else echo '<br><h2><p dir="rtl" lang="he" class="source-text-area">';
            
            if (strlen($pdv)>0)
                echo  $pdv . '</p></h2><br>';
            else  echo  $dv . '</p></h2><br>';
            
        } else {
            include_once __DIR__ . "/not_block_output.php";
            not_block_output($dv,$hebcit);
        }
        if ($push_buttons)
        {
            if ($key > 0) push_buttons($key);
            else cit_push_buttons(str_replace(")(",",",substr($engcit, 1, -1)));
            /*{
              if (strpos($engcit,"(") === false) {$key = convertor(0,$engcit);}
              else  {$key = convertor(0,str_replace(")(",",",substr($engcit, 1, -1)));}
              push_buttons($key);
               }*/
        }
        if ($buttons)
        { //remove combination of trim to remove leading and trailing whitespace, and preg_replace to replace all newlines and their surrounding spaces. and Remove Text Between Parentheses
            $str = preg_replace ('/s*Rs*/', ' ', trim (preg_replace("/\([^)]+\)/","",$dv)));
            button_wrap($hebcit,$str,$url_output,$engcit);
        }
        if (strpos($engcit,"(") === false) {echo  url_create($engcit,$hebcit,"",$highlight);}
        else  {echo  url_create(str_replace(")(",",",substr($engcit, 1, -1)),$hebcit,"",$highlight);}
    } else {
       include __DIR__ . "/text_header.php";
       text_output((str_replace(")(",",",substr($engcit, 1, -1))), preg_replace ('/s*Rs*/', ' ', trim (preg_replace("/\([^)]+\)/","",$dv))));
       //text_only($engcit. preg_replace ('/s*Rs*/', ' ', trim (preg_replace("/\([^)]+\)/","",$dv))));
    }
}
