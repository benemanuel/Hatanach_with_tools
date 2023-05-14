<?php
include_once __DIR__ . "/booklookup.php";
include_once __DIR__ . "/gematria.php";
include_once __DIR__ . "/hebrewize.php";
include_once __DIR__ . "/calls.php";
include_once __DIR__ . "/show_sedarim.php";

function sedarim_verse($verse_stream){
global $debug_flag;
//$debug_flag=false;
$sedarim_citation=true;
$highlight_key=0;
$heb_citation=false;

    if ($debug_flag) {echo "<p debug='fun sedarim_verse:"."'></p>";}


    $sed_cit="";
    $keyvalue_index=0;
    $hebchap_index=1;
    $hebverse_index=2;
    $book_index=3;
    $bookname_index=4;
    $ch_index=5;
    $vr_index=6;
    $show_entire_sedar=$verse_stream[0]>1;
    if (($sedarim_citation)  &&  ($show_entire_sedar)) {
      $sedar=show_sedarim($highlight_key)[1];
      $b1=show_book($sedar[3],2);
      $b2=show_book($sedar[3],4);
      if ($debug_flag) {echo "<p debug='sedarim_verse sedarim_citation:";  print_r(array($b1,$b2));  echo "'></p>";}
      echo '<h2><p dir="rtl" lang="he" class="source-text-area-title">';
      if ($b1 == $b2) { $sed_cit="[ספר:".$b2;}
      else
        {  $sed_cit="[ספר:(".$b1.") ".$b2;}
      $sed_cit=$sed_cit. " כל סדר:".number2hebrew($sedar[1]);
      echo $sed_cit. "]</br></p>".PHP_EOL;
      }
    if ($debug_flag) {echo "<p debug='sedarim_verse count verses:";  print_r($verse_stream[0]);  echo "'></p>";}
 for ($i = 1; $i <= $verse_stream[0]; $i++)
   {
    $bookcode=$verse_stream[$i][$book_index];
    $shortbook=show_book($bookcode);
    $ch=$verse_stream[$i][$ch_index];
    $vr=$verse_stream[$i][$vr_index];
    $cit=$shortbook."".$ch.":".$vr;
#    $hebcitation= '('. hebrewize($bookcode,$ch , $vr) . ')';
    $key=$verse_stream[$i][$keyvalue_index];
        
#    $citurl="<a target = '_blank' href='https://hatanach.geulah.org.il/verse/?verse=".$cit."'/>(".$cit.")</a>";
#    $hebciturl="<a target = '_blank' href='https://hatanach.geulah.org.il/verse/?verse=".$cit."'/>".$hebcitation."</a>";
#    $keyurl="<a target = '_blank' href='https://hatanach.geulah.org.il/verse/?key=".$key."'/>VerseKey:".$key."</a>";

    $sedar=show_sedarim($key)[1];
    $verse=vprint(verse_get($key));


    if ($debug_flag) {echo "<p debug='sedarim_verse:";  print_r(array($sedar,$cit,$key));  echo "'></p>";}
     if ($highlight_key == $key) {
         echo '<h2><p dir="rtl" lang="he" class="source-text-highlighted-area">';
#         $high_engcit="(". $cit .")";
#         $high_hebcit= $hebcitation;
#         $high_pasuk=$verse;
#         $high_url="https://hatanach.geulah.org.il/verse/?verse=" . $cit;
        } else {
         echo '<h2><p dir="rtl" lang="he" class="source-text-area">';
        }


     if ($heb_citation) {
         $hebcitation= '('. hebrewize($bookcode,$ch , $vr) . ')';
         echo $hebcitation;
     }
     echo $verse."</br>".PHP_EOL;

     if ($sedarim_citation) {
         $b1=show_book($sedar[3],2);
         $b2=show_book($sedar[3],4);
         if (!($show_entire_sedar))
         { if ($b1 == $b2) { $sed_cit="[ספר:".$b2;}
          else
            {$sed_cit="[ספר:(".$b1.") ".$b2;}
            $sed_cit=$sed_cit. " סדר:".number2hebrew($sedar[1]);
            echo $sed_cit. " פיסקה:".number2hebrew($sedar[2])."]</br>".PHP_EOL;}
         else {echo "[פיסקה:".number2hebrew($sedar[2])."]</br>";}

     }
     
     echo  "</p></h2>". PHP_EOL;
   }
}



//$s=array(1,array(1000,3,23,1,"Genesis",4,20));

//sedarim_verse($s);


/*include_once __DIR__ . "/show_sedarim.php";
echo PHP_EOL."show_sedarim <br>".PHP_EOL;
$s=show_sedarim(1000);
sedarim_verse($s);
*/

//$s=show_fullsedarim(1000);
//echo PHP_EOL."show_fullsedarim <br>".PHP_EOL;
//print_r(show_fullsedarim(1000));
//sedarim_verse($s);

