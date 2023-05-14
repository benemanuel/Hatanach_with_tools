<?php
function clean_word($word,$accent=false,$key=0,$wordlist_only=true){
include_once 'tav.php';
            $word = trim($word);
            $word_mesora = 0;
            foreach (mb_str_split($word) as $char){
               $result = tav($char, 0);
               switch ($result[0])
              {
               case 0:
                    $word = str_replace($char, '', $word);
                    break;
               case 1:
               case 2:
                   // letters - needed
                    break;
               case 3:
                   // vowels - needed
                   break;
               case 4:
               case 5:
                    if (!$accent) {$word = str_replace($char, '', $word);}
                    break;
               case 6:
                   switch ($result[5])
                   {
                   case "MAQAF": break; //  - needed
                   case "RAFE":
                       $word = str_replace($char, '', $word);
                       break;
                    }
                    break;
               case 7:
                    $word = str_replace($char, '', $word);
                    break;
               case 8:
                   if ($wordlist_only){
                   switch ($result[5])
                       {
                       case "PASEQ": $word = str_replace($char, '', $word); break;
                       case "NUN HAFUKHA": $word = str_replace($char, '', $word); break;
                       case "YIDDISH DOUBLE VAV": $word = str_replace($char, '', $word); break;
                       case "YIDDISH VAV YOD": $word = str_replace($char, '', $word); break;
                       case "YIDDISH DOUBLE YOD": $word = str_replace($char, '', $word); break;
                       case "SOF PASUQ": $word = str_replace($char, '', $word); break;
                       case "SPACE": $word = str_replace($char, '', $word); break;
                       }
                    } else {
                   switch ($result[5])
                       {
                       case "PASEQ": 
                       case "NUN HAFUKHA":
                       case "YIDDISH DOUBLE VAV":
                       case "YIDDISH VAV YOD":
                       case "YIDDISH DOUBLE YOD": break;
                       case "SOF PASUQ": 
                       case "SPACE": $word = str_replace($char, '', $word); break;
                       }
                   }
                    break;
               case 9:
                    $word = str_replace($char, '', $word);
                    if ($wordlist_only){
                       if ($key>0)
                         {
                             //$word_mesora = check_verse_extras($key,comment);
                             //if ($word_mesora == 1)
                             //{
                             //   $word_mesora++;
                             //}
                         }
                     }
                    else  $word_mesora++;
                    // mesora - kri/ktiv needed
                    break;
               default:
                   $word = str_replace($char, '', $word);
                   break;
             }
           }
            return [$word,$word_mesora];
}


