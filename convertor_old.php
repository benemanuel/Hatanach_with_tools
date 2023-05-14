<?php
function convertor($key=0,$cit="",$osis=false){
    /*replacement of
     give_cit_from_key.php
     convert_cit_key.php
    */
    include_once __DIR__ . "/db_call.php";
    include_once __DIR__ . "/booklookup.php"; //for show_book & shorteng_bookcode
    include_once __DIR__ . "/single_verse.php";

    
    global $debug_flag;

    if (($key > 0) xor (strlen($cit)>1))
    {

        if ($key > 0){
            $query = "SELECT  book,ch,vr  FROM words_full WHERE keyvalue >= ". $key ." and wordnumber= 1 LIMIT 1" ;
            if ($debug_flag) echo PHP_EOL."<p debug= 'convertor $key query=:$query'></p>";
            
            $data = db_call("words_full",$query);
            $bk = $data[0]['book'];
            $ch = $data[0]['ch'];
            $vr = $data[0]['vr'];
            
            $shortbook = show_book($bk);
            if (!$osis) {
                $answer= $shortbook . $ch . ':' . $vr;
            } else {
                $answer= $shortbook . '.'.$ch . '.' . $vr;
            }
        } else {
            $command_line =
                          "cd  /var/www/hatanach/verse/script/ && node citapp.js -c " .
                          " '" .
                          $cit .
                          "'  2>&1";
            $osis = exec($command_line, $out, $err);
            if (single_verse($osis))
            {
                $bcv = explode(".", $osis);
                //echo " count=". count($bcv). PHP_EOL;
                switch (count($bcv)) {
                case 1:
                    //only book
                    $verse_number=1;
                    $chapter_number=1;
                    list($book) = $bcv;
                    if (strpos($book, "EEE") > 0) {$book_code=shorteng_bookcode($cit);} else {$book_code=shorteng_bookcode($book);}
                    break;
                case 2:
                    //only chapter
                    $verse_number=1;
                    list($book, $chapter_number) = $bcv;
                    $book_code=shorteng_bookcode($book);
                    break;
                case 3:
                    // verse exist in osis
                    list($book, $chapter_number, $verse_number) = $bcv;
                    $book_code=shorteng_bookcode($book);
                    break;
                default:
                    $verse_number=1;
                    $chapter_number=1;
                    $book_code=1;
                    break;
                }
                $st=" book= ".$book_code ." and ch= ". $chapter_number." and vr=".  $verse_number;
                if ($debug_flag) {echo "<p debug='convert_cit_key end"; var_dump($book_code,$chapter_number,$verse_number); echo "'></p>";}
                $query = "SELECT  keyvalue FROM words_full WHERE ".$st." and wordnumber= 1 LIMIT 1" ;
                if ($debug_flag) echo PHP_EOL."<p debug= 'convertor $cit query=:$query'></p>";
                
                $data = db_call("words_full",$query);
                //$answer=$data[0]['keyvalue'];
                $answer = isset($data[0]['keyvalue']) ? $data[0]['keyvalue'] : -1;
            }  else return -2;
            return $answer;
        }
    } return -1;
}


