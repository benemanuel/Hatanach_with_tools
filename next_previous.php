<?PHP
function next_verse($key=0,$cit=""){
    global $debug_flag;
    include_once __DIR__ . "/db_call.php";
    include_once __DIR__ . "/booklookup.php";
    include_once __DIR__ . "/convertor.php";
    if (($key > 0) xor (strlen($cit)>1))
    {
        if (($key<232130) && ($key > 0)){ //last one no next
            $query = "SELECT  book,ch,vr  FROM words_full WHERE keyvalue >= ". ($key + 1) ." and wordnumber= 1 LIMIT 1" ;
            $data = db_call("words_full",$query);
            $cit = show_book($data[0]['book']).$data[0]['ch'].":".$data[0]['vr'];
            $newkey = convertor(0,$cit);
            return $newkey;
        } else {
            $key = convertor(0,$cit);
            //echo "using cit=".$cit." key is ". $key. PHP_EOL;
            $newkey = next_verse($key);
            return convertor($newkey);
        }
    } else return -1;
}

function previous_verse($key=0,$cit=""){
    global $debug_flag;
    include_once __DIR__ . "/db_call.php";
    include_once __DIR__ . "/booklookup.php";
    include_once __DIR__ . "/convertor.php";
    if (($key > 0) xor (strlen($cit)>1))
    {
        if ($key>10){ //first one no previous
        $index=0;
        do {
            $index = $index+5;
            $query = "SELECT  book,ch,vr  FROM words_full WHERE keyvalue >= ". ($key - $index) ." and wordnumber= 1 LIMIT 1" ;
            $data = db_call("words_full",$query);
            $cit = show_book($data[0]['book']).$data[0]['ch'].":".$data[0]['vr'];
            $newkey = convertor(0,$cit);
        } while ($newkey == $key);
        return $newkey;
    } else {
            $key = convertor(0,$cit);
            //echo "using cit=".$cit." key is ". $key. PHP_EOL;
            $newkey = previous_verse($key);
            return convertor($newkey);
        }
    } else return -1;
}


function next_chapter($key=0,$cit=""){
    global $debug_flag;
    include_once __DIR__ . "/db_call.php";
    include_once __DIR__ . "/booklookup.php";
    include_once __DIR__ . "/convertor.php";
    if (($key > 0) xor (strlen($cit)>1))
    {
        if (($key<232130) && ($key > 0)){ //last one no next
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
            return $newkey;
        } else {
            $key = convertor(0,$cit);
            //echo "using cit=".$cit." key is ". $key. PHP_EOL;
            $newkey = next_chapter($key);
            return convertor($newkey);
        }
    } else return -1;
}

function previous_chapter($key=0,$cit=""){
    global $debug_flag;
    include_once __DIR__ . "/db_call.php";
    include_once __DIR__ . "/booklookup.php";
    include_once __DIR__ . "/convertor.php";
    if (($key > 0) xor (strlen($cit)>1))
    {
        if ($key>10){ //first one no previous
            $query = "SELECT  book,ch,vr  FROM words_full WHERE keyvalue >= ". $key  ." and wordnumber= 1 LIMIT 1" ;
            $data = db_call("words_full",$query);
            $cit = show_book($data[0]['book']).$data[0]['ch'].":".$data[0]['vr'];
            //echo "cit=".$cit.PHP_EOL;
            $query = "SELECT  keyvalue  FROM words_full WHERE ch = ". ($data[0]['ch'] - 1)  ." and book = ". $data[0]['book'] ." and wordnumber= 1 LIMIT 1" ;
            $data = db_call("words_full",$query);
            //print_r($data);
            $newkey = isset($data[0]['keyvalue']) ? $data[0]['keyvalue'] : -1;
            //echo "newkey=".$newkey.PHP_EOL;
            return $newkey;
        } else {
            $key = convertor(0,$cit);
            //echo "using cit=".$cit." key is ". $key. PHP_EOL;
            $newkey = previous_chapter($key);
            return convertor($newkey);
        }
    } else return -1;
}


