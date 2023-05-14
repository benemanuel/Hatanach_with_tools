<?php
#cat /var/www/hatanach/verse/setup/Comment_table.txt |awk -F, '{print "case "$3": $h_topic="$1"; $topic=" $2"; break"}'|sed 's/=/="/g'| sed 's/;/";/g'|sed 's/break/break;/g' >> mesora.php

function mesora($reason){
    switch ($reason){
    case 0: $h_topic=""; $topic=""; break;
    case 1: $h_topic="﻿קרי_וכתיב"; $topic="Qere and Ketiv"; break;
    case 2: $h_topic="טעמים"; $topic="Cantillation marks"; break;
    case 3: $h_topic="סימון"; $topic="Dots"; break;
    case 4: $h_topic="הבהרה"; $topic="Pronunciation"; break;
    case 5: $h_topic="סבירין"; $topic="Probably understood"; break;
    case 6: $h_topic="ניקוד"; $topic="Grammar and vowels"; break;
    case 7: $h_topic="צ׳׳ל"; $topic="Accepted option"; break;
    case 8: $h_topic="נ׳׳א"; $topic="Rejected option"; break;
    case 9: $h_topic="צורת_האות"; $topic="Typography"; break;
    case 10: $h_topic="הוראת_כתיבה"; $topic="Writting instructions"; break;
    case 11: $h_topic="קדש"; $topic="Holiness of word"; break;
    case 12: $h_topic="מידע"; $topic="Information"; break;
    case 13: $h_topic="הפטרה"; $topic="Haftorot"; break;
    }
    return array($h_topic,$topic);
}

function footnote($note,$foot,$inline=true){
    //         return  "<details><summary>".$note.'</summary><div class="details-content">'.$foot."</div></details>";
    if ($inline)
        return  "<sub>".$note."</sub><sup>".$foot."</sup>";
    else
        return  '<a class="footnote">'.$note."<span>".$foot."</span></a>";
}

/*
function footed($line,$key,$comment_list=array(1,2,3,4,5,6,7,8,9,10,11,12,13)){
    include_once __DIR__ . "/show_comments_full.php";
    $respond="";
    $inline=false;
    $i=0;
    foreach (explode(' ', $line) as $word){
        $i++;
        $mesora_status=show_comments_full($key,$i,$comment_list);
        if ($mesora_status[0])
        {
            $word_written_already=false;
            for ($x=1;$x<=$mesora_status[0];$x++){
                //echo "<p dir=ltr>[".$i."]".":".json_encode($mesora_status[$x],JSON_UNESCAPED_UNICODE)."</p>".PHP_EOL;
                if (in_array($mesora_status[$x][7], $comment_list))
                { 
                    switch($mesora_status[$x][7]){
                    case 1: $reason="קרי_וכתיב"; $er="Qere_and_Ketiv"; $inline=true; $notes=$mesora_status[$x][8]; break;
                    case 2: $reason="טעמים"; $er="Cantillation_marks"; $inline=false; $notes=$mesora_status[$x][6]; break;
                    case 3: $reason="סימון"; $er="Dots"; $inline=false; $notes=$mesora_status[$x][6]; break;
                    case 4: $reason="הבהרה"; $er="Pronunciation"; $inline=false; $notes=$mesora_status[$x][6]; break;
                    case 5: $reason="סבירין"; $er="Probably_understood"; $inline=false; $notes=$mesora_status[$x][6]; break;
                    case 6: $reason="ניקוד"; $er="Grammar_and_vowels"; $inline=false; $notes=$mesora_status[$x][6]; break;
                    case 7: $reason="צ׳׳ל"; $er="Accepted_option"; $inline=false; $notes=$mesora_status[$x][6]; break;
                    case 8: $reason="נ׳׳א"; $er="Rejected_option"; $inline=false; $notes=$mesora_status[$x][6]; break;
                    case 9: $reason="צורת_האות"; $er="Typography"; $inline=false; $notes=$mesora_status[$x][6]; break;
                    case 10: $reason="הוראת_כתיבה"; $er="Writing_instructions"; $inline=false; $notes=$mesora_status[$x][6]; break;
                    case 11: $reason="קדש"; $er="Holiness_of_word"; $inline=false; $notes=$mesora_status[$x][6]; break;
                    case 12: $reason="מידע"; $er="Information"; $inline=false; $notes=$mesora_status[$x][6]; break;
                    case 13: $reason="הפטרה"; $er="Haftorot"; $inline=false; $notes=$mesora_status[$x][6]; break;
                    default: $reason="לא_ידוע"; $er="Other";
                    }
                    if ($word_written_already) {$respond.=footnote("",$notes,$inline);}
                    else {
                        $word_written_already=true;
                        $respond.=" ".footnote($word,$notes,$inline);
                    }
                } else  if (!$word_written_already) {$respond.=" ".$word; $word_written_already=true;} 
            }
        } else $respond.=" ".$word;
    }
    return  $respond;
}
*/
