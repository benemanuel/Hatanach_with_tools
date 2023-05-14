<?php

function tf($str){
    global $tweet_display;
    if ($tweet_display)  echo  "<td>" .$str. "</td>";
}


function tweet_call($title="",$cit,$high=0){
    include_once __DIR__ . "/mesora.php";
    //include_once __DIR__ . "/show_extra.php";
    //include_once __DIR__ . "/verse_get.php";
    //include_once __DIR__ . "/convertor.php";
    include_once __DIR__ . "/booklookup.php";
    include_once __DIR__ . "/clean_word.php";
    include_once __DIR__ . "/gematria.php";
    include_once __DIR__ . "/fix_peh_samach.php";
    include_once __DIR__ . "/acv.php";

    global $highlight;
    global $debug_flag;
    global $engraving_display;
    global $tweet_display;
    
    if ($debug_flag) {echo PHP_EOL."<p debug='tweet_call:";  print_r($cit);  echo "'></p>";}
     $command_line =
    "cd  /var/www/hatanach/verse/script/ && node citapp.js -c " .
    " '" .
    $cit .
    "'  2>&1";

    $osis = exec($command_line, $out, $err);
    if (!strpos($osis, "EEE") > 0)
    {
        if ($tweet_display) echo '<table  class="source-text-area">';
        if ($tweet_display) {echo ' <colgroup>
        <col span="6" style="background-color: #D6EEEE">
        </colgroup>';}
        if ($tweet_display) {echo '<tr>
    <th>Index</th>
    <th>Cit</th>
    <th>Book</th>
    <th>Ch</th>
    <th>Vr</th>
    <th>#in</th>
    <th>Word</th>
    <th>Mesora</th>
    <th>Translit</th>
    <th>Havarot</th>
    <th>#Hav</th>
    <th>THav</th>
    <th>Melody</th>
    </tr>';}
        list($hebcit,$citarray,$url_output,$engcit)=acv($osis);
        $dv="";
        $hebrew_lyrics="";
        $translit_lyrics="";
        $melody="";
        $starting=null;
        $hhc=0; $thc=0; $mc=0;
        $breakhere=false; $breakcount=0;
        //$bcv = str_replace(")(",",",substr($engcit, 1, -1));
        foreach ($citarray as $index => $word) {
            if ($word['wordnumber']==1) {
                $the_note=0;
                if (!isset($starting)) {
                     $starting=show_book($word['book']).$word['ch'].":".$word['vr'];}
                $section=tnk(show_book($word['book'],3));
                //if ($highlight) $dv.='</span>';
                //$dv.= " (".number2hebrew($word['vr']).")";
                $highlight = $word['vr'] == $high;
                //if ($highlight) $dv.='<span class=source-text-highlighted-area>';
            }
            $wd = clean_word($word['word_ktiv'],true)[0];
            if (strlen($wd)>0)
            {
                if ($tweet_display) {if ($highlight) echo PHP_EOL.'<tr class="source-text-highlighted-area">';
                    else echo  PHP_EOL.'<tr>';}
                tf($index);//<th>Index</th>
                tf(show_book($word['book']).$word['ch'].":".$word['vr']);//<th>Cit</th>
                tf(show_book($word['book'],2));//<th>Book</th>
                $cp=$word['ch'];
                tf(number2hebrew($cp));//<th>Ch</th>
                $vr=$word['vr'];
                tf(number2hebrew($vr));//<th>Vr</th>
                tf($word['wordnumber']);//<th>#in</th>
                tf($wd);//<th>Word</th>
                if ($word['reason']>0) tf(mesora($word['reason'])[0]); else tf("");//<th>Mesora</th>
                //if ($word['reason']==0)
                //{
                //    if ($index==0) $vr_start = $word['vr'];
                //    $dv.=" ".fix_peh_samach($word['word_ktiv'],false);
                //}
                $thavarot = explode(',',  preg_replace('/[\[\]\']/', '', $word['translit']));
                $thavarot = array_map('trim', $thavarot);
                $tcount=count($thavarot);
                $thc = $thc + $tcount;
                $breakcount = $breakcount +  $tcount;
                //tf(json_encode($thavarot,JSON_UNESCAPED_UNICODE));

                if ($tweet_display) echo  '<td class="transliteration-text-area">';//<th>Translit</th>
                $thavarot=json_encode($thavarot,JSON_UNESCAPED_UNICODE);
                if ($tweet_display) echo $thavarot;
                if ($tweet_display) echo '</td>';
                
                $hhavarot = explode(',', preg_replace('/[\[\]\']/', '', $word['word_havarot']));
                $hhavarot = array_map('trim', $hhavarot);
                $hcount = count($hhavarot);
                $hhc = $hhc + $hcount;
                $hw=json_encode($hhavarot,JSON_UNESCAPED_UNICODE);
                tf($hw);//<th>Havarot</th>
                if ($tcount == $hcount)//<th>#Hav</th>
                {
                    tf($hcount);
                } else {
                    if ($tweet_display) {echo "<td>"; echo $hcount.",".$tcount; echo "</td>";}//
                    $breakhere=true;
                }
                include_once __DIR__ . "/mnote.php";
                if (!defined('itsmusic')) define('itsmusic',"\u{1d160}");

                if (!defined('notes')) define('notes',array("-4"=>"G'", "-3"=>"A","-2"=>"B", "-1"=>"C", "0"=>"D", "1"=>"E", "2"=>"F", "3"=>"G", "4"=>"A", "5"=>"B", "6"=>"c", "7"=>"d", "8"=>"e"));

                //---------------BUILDING MUSIC LINE-----------------------------------------------------
                $hword_string = ''; $melody_string = '';
                for ($i = 0; $i < $hcount; $i++)
                {
                    $note_in_havara = false;
                    $hword_string .= "[";
                    $melody_string .= "("; $mc = $mc + 1;
                    $a = 0;
                    foreach (mb_str_split($hhavarot[$i]) as $char){
                        $z=mnote($char); //[4/5,absolute note on scale/array of realitive note changes,]
                    //                    $present_note = $z[1];
                        $char_type = $z[0];
                        switch ($char_type){
                        case '1':
                        case '2': $hword_string .= $char;
                            break;
                        case '3':$hword_string .= $char;
                            break;
                        case '4': $note_in_havara = true;
                            $music_note = $z[1];
                            $a++;
                            $hword_string .=  itsmusic.notes[$music_note];
                            $melody_string .= notes[$music_note];
                            $the_note = $music_note;
                            break;
                        case '5': $note_in_havara = true;
                            $music_rules = $z[1];
                            $ncount = count($music_rules);
                            for ($nc = 0;$nc < $ncount;$nc++)
                            {
                                $a++;
                                //if ($debug_flag) {
                                //  echo "<p debug='music rule #"; echo $nc."["; print_r($music_rules[$nc]); echo "]{";
                                //  echo $the_note+$music_rules[$nc]; echo "}'></p>";}
                                $hword_string .=  itsmusic. notes[$the_note+$music_rules[$nc]];
                                $melody_string .= notes[$the_note+$music_rules[$nc]];
                            }
                              break;
                        case '6': $hword_string .= $char; break;
                        case '8': if ($z[5] == "SOF PASUQ")
                              {
                                 $melody_string .= "z". PHP_EOL;
                                 //$tw .= PHP_EOL;
                                 $hw .= "*";
                                 $thavarot .= PHP_EOL;
                                 if ($breakcount > 30) $breakcount=true;
                              }
                            break;
                        default: $hword_string .= $char;
                            break;
                        }
                    }
                    if (!$note_in_havara)
                    {
                        $hword_string .=  itsmusic.notes[$the_note];
                        $melody_string .= notes[$the_note];
                    }
                    $hword_string .= "]";
                    $melody_string .= ")";
                    if ($a > 1) {
                        $melody_string .= "/".$a;
                    }
                }
                $melody_string .= ",";
                tf($hword_string);//<th>THav</th> 
                //--------------------------------------------------------------------
                //$hebrew_lyrics.= str_replace(",",",",str_replace('"'," ",str_replace("]","",str_replace("[","",$hw))));
                $hebrew_lyrics.= str_replace("[","",str_replace('"',"",str_replace("]"," ",str_replace(",",",",$hw))));
                //$translit_lyrics.= str_replace(",",",",str_replace('"'," ",str_replace("]","",str_replace("[","",$thavarot))));
                $translit_lyrics.= str_replace("[","",str_replace('"',"",str_replace("]"," ",str_replace(",",",",$thavarot))));
                tf(rtrim($melody_string, ","));//<th>Melody</th>
                $melody.= str_replace(", "," ",str_replace(")",",",str_replace(")/","/",str_replace("(","",str_replace(","," ",$melody_string)))));
                //--------------------------------------------------------------------
           
            if ($tweet_display) echo '</tr>';
            }
        }
        //$translit_lyrics = substr($translit_lyrics, 1);
              //$hebrew_lyrics = substr($hebrew_lyrics, 1);
              if ($debug_flag) {
                                 echo "<p debug='melodies".PHP_EOL;
                                 echo "hl="; print_r($hebrew_lyrics); echo "<br>".PHP_EOL;
                                 echo "tl="; print_r($translit_lyrics); echo "<br>".PHP_EOL;
                                 echo "m=";  print_r($melody); echo "<br>".PHP_EOL;
                                 echo "h#=".$hhc."=". (substr_count($hebrew_lyrics,",")+substr_count($hebrew_lyrics," "))."<br>".PHP_EOL;
                                 echo "t#=".$thc."=". (substr_count($translit_lyrics,",")+substr_count($translit_lyrics," "))."<br>".PHP_EOL;
                                 echo "m#=".$mc."=". (substr_count($melody,",")+substr_count($melody," "))."<br>".PHP_EOL;
                                 
                                                 echo "}'></p>";}

        if ($tweet_display) echo "</table><br><br>";
        if ($engraving_display)
        {
            include __DIR__ . "/abc.php";
            engrave_music($starting."-".$cp.":".$vr,"https://github.com/benemanuel/MusicoftheBibleRevealed",$section,$melody,$hebrew_lyrics,$translit_lyrics,$title);
        }
    }
}
