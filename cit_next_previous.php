<?PHP
function cit_next_verse($cit=""){
    global $debug_flag;
    include_once __DIR__ . "/db_call.php";
    include_once __DIR__ . "/booklookup.php";
    include_once __DIR__ . "/convertor.php";
    if (strlen($cit)>1){
            $key = convertor(0,$cit);
            if ($debug_flag){ echo PHP_EOL."<p debug=cit_next_verse c='". $cit." k=".$key."'></p>";}
            //echo "key=".$key. PHP_EOL;
            $query = "SELECT  book,ch,vr  FROM words_full WHERE keyvalue >= ". ($key + 1) ." and wordnumber= 1 LIMIT 1" ;
            //echo "query=".$query. PHP_EOL;
            $data = db_call("words_full",$query);
            $cit = isset($data[0]['book']) ? show_book($data[0]['book']).$data[0]['ch'].":".$data[0]['vr'] : "";
            //            $cit = show_book($data[0]['book']).$data[0]['ch'].":".$data[0]['vr'];
            return $cit;
    } else return -1;
}

function cit_previous_verse($cit=""){
    global $debug_flag;
    include_once __DIR__ . "/db_call.php";
    include_once __DIR__ . "/booklookup.php";
    include_once __DIR__ . "/convertor.php";
    if (strlen($cit)>1){
        $key = convertor(0,$cit);
        if ($debug_flag){ echo PHP_EOL."<p debug=cit_previous_verse c='". $cit." k=".$key."'></p>";}
        $index = 0;
        do {
            $index = $index + 5;
            $query = "SELECT  book,ch,vr  FROM words_full WHERE keyvalue >= ". ($key - $index) ." and wordnumber= 1 LIMIT 1" ;
            $data = db_call("words_full",$query);
            $newcit = show_book($data[0]['book']).$data[0]['ch'].":".$data[0]['vr'];
            $newkey = convertor(0,$newcit);
            //  echo "i=".$index." nc=".$newcit." nk=".$newkey.PHP_EOL;
        } while ($newkey == $key);
        //        echo " newkey=".$newkey.PHP_EOL;
        return convertor($newkey);
    } else return -1;
}


function cit_next_chapter($cit=""){
    global $debug_flag;
    include_once __DIR__ . "/db_call.php";
    include_once __DIR__ . "/booklookup.php";
    include_once __DIR__ . "/convertor.php";
    if (strlen($cit)>1){
            $key = convertor(0,$cit);
            if ($debug_flag){ echo PHP_EOL."<p debug=cit_next_chapter c='". $cit." k=".$key."'></p>";}
            $query = "SELECT  book,ch,vr  FROM words_full WHERE keyvalue >= ". $key  ." and wordnumber= 1 LIMIT 1" ;
            $data = db_call("words_full",$query);
            $cit = show_book($data[0]['book']).$data[0]['ch'].":".$data[0]['vr'];
            //echo "cit=".$cit.PHP_EOL;
            $query = "SELECT  keyvalue  FROM words_full WHERE ch > ". $data[0]['ch']  ." and book = ". $data[0]['book'] ." and wordnumber= 1 LIMIT 1" ;
            //echo "query=". $query.PHP_EOL;
            $data = db_call("words_full",$query);
            //print_r($data);
            $newkey = isset($data[0]['keyvalue']) ? $data[0]['keyvalue'] : -1;
            //echo "newkey=".$newkey.PHP_EOL;
            $newcit = convertor($newkey);
            return substr($newcit, 0, strpos($newcit, ":"));
    } else return -1;
}

function cit_previous_chapter($cit=""){
    global $debug_flag;
    include_once __DIR__ . "/db_call.php";
    include_once __DIR__ . "/booklookup.php";
    include_once __DIR__ . "/convertor.php";
    if (strlen($cit)>1){
            $key = convertor(0,$cit);
            if ($debug_flag){ echo PHP_EOL."<p debug=cit_previous_chapter c='". $cit." k=".$key."'></p>";}
            $query = "SELECT  book,ch,vr  FROM words_full WHERE keyvalue >= ". $key  ." and wordnumber= 1 LIMIT 1" ;
            $data = db_call("words_full",$query);
            $cit = show_book($data[0]['book']).$data[0]['ch'].":".$data[0]['vr'];
            //echo "cit=".$cit.PHP_EOL;
            $query = "SELECT  keyvalue  FROM words_full WHERE ch = ". ($data[0]['ch'] - 1)  ." and book = ". $data[0]['book'] ." and wordnumber= 1 LIMIT 1" ;
            $data = db_call("words_full",$query);
            //print_r($data);
            $newkey = isset($data[0]['keyvalue']) ? $data[0]['keyvalue'] : -1;
            //echo "newkey=".$newkey.PHP_EOL;
            $newcit = convertor($newkey);
            return substr($newcit, 0, strpos($newcit, ":"));
    } else return -1;
}


