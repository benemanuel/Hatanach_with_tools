<?php
//gets  key returns ($book,$chap,$verse)
function show_sedarim($key){#book,$chap,$verse
    global $debug_flag;
    include_once __DIR__ . "/db_call.php";
    if ($key > 1){
        global $debug_flag;
        /*
          +----------+-------------+
          | Field    | Type        |
          +----------+-------------+
          | keyvalue | int(11)     |
          | hebchap  | int(11)     |
          | hebverse | int(11)     |
          | book     | int(11)     |
          | bookname | varchar(16) |
          | ch       | int(11)     |
          | vr       | int(11)     |
          +----------+-------------+
        */
        if ($debug_flag) {echo PHP_EOL."<p debug='fun show_sedarim:". $key ."'></p>";}
        $result=db_call('sedarim','select * from sedarim WHERE keyvalue = '. $key);
        $value=array(0);
        foreach ($result as $index => $row) {
            array_push($value,[$row['keyvalue'],$row['hebchap'],$row['hebverse'],$row['book'],
                               $row['bookname'],$row['ch'],$row['vr']]);
            $value[0] = $index+1;
        }
    } else $value[0] = 0;
    if ($debug_flag) {echo PHP_EOL."<p debug='show_sedarim called:"; print_r($value);  echo "'></p>";}
    return $value;
}


//gets  key chap returns $text ($book,$chap,$verse)
function show_fullsedarim($key){#$text ($book,$chap,$verse)
        global $debug_flag;
        include_once __DIR__ . "/db_call.php";

        $keyvalue_index=0;
        $hebchap_index=1;
        $hebverse_index=2;
        $book_index=3;
        $bookname_index=4;
        $ch_index=5;
        $vr_index=6;
        
        if ($key > 1){
            $s=show_sedarim($key)[1];
            $sedarbook=$s[$bookname_index];
            $sedarchap=$s[$hebchap_index];
            $result = db_call('sedarim','select * from sedarim where hebchap = '.$sedarchap.' AND bookname = "'.$sedarbook.'"');
            $value = array (0);
            foreach ($result as $index => $row) {
                array_push($value,[$row['keyvalue'],$row['hebchap'],$row['hebverse'],$row['book'],
                                   $row['bookname'],$row['ch'],$row['vr']]);
                $value[0] = $index+1;
            }

            if ($debug_flag) {echo PHP_EOL."<p debug='show_fullsedarim called:"; print_r($value);  echo "'></p>";}
            return $value;
        }
        else  return [0];
}

