<?php
function show_verse($key){#book,chap,vr,verse
    // show_verse isn't used
    include_once __DIR__ . "/verse_get.php";
    include_once __DIR__ . "/acv.php";

    if ($key > 1){
        $value = show_word($key);
        //        print_r($value);
     return [$value[1]['book'], $value[1]['ch'],$value[1]['vr'],sv($key)];
     //return [$value[1][0], $value[1][1],$value[1][2],fix_peh_samach($value[1][3])];
     }
    else  return [0,0,0,""];
   }
