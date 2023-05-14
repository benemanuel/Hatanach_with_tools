<?php
function all_sedarim_verse($verse_stream, $highlight_key=0){

    global $cit;
    global $cit_call;
    global $citation_url;
    global $comment_display;
    global $debug_flag;
    global $editor_display;
    global $heb_citation;
    global $hebcitation_url;
    global $hebrew_display;
    global $highlight;
    global $highlight_call;
    global $key;
    global $key_call;
    global $key_url;
    global $random_call;
    global $sedarim_citation;

    if ($debug_flag) {echo "<p debug='fun all_sedarim_verse:"."'></p>";}
    //global $high_pasuk,$high_url,$high_hebcit,$high_engcit, $sed_cit;

    if (!defined('html')) define('html',1);
    if (!defined('text_only')) define('text_only',0);
    $sed_cit="";
    $keyvalue_index=0;
    $hebchap_index=1;
    $hebverse_index=2;
    $book_index=3;
    $bookname_index=4;
    $ch_index=5;
    $vr_index=6;
    $show_entire_sedar = ($verse_stream[0]>1) ? true : false;
    if (($sedarim_citation) && ($show_entire_sedar)) {
      $sedar=show_sedarim($highlight_key)[1];
      $b1=show_book($sedar[3],2);
      $b2=show_book($sedar[3],4);
      //if ($debug_flag) {echo "<p debug='all_sedarim_verse sedarim_citation:";  print_r(array($b1,$b2));  echo "'></p>";}
      echo '<h2><p dir="rtl" lang="he" class="source-text-area-title">';
      if ($b1 == $b2) { $sed_cit="[ספר:".$b2;}
      else
        {  $sed_cit="[ספר:(".$b1.") ".$b2;}
      $sed_cit=$sed_cit. " כל סדר:".number2hebrew($sedar[1]);
      echo $sed_cit. "]</br></p>".PHP_EOL;
    }
    // if ($debug_flag) {echo "<p debug='all_sedarim_verse count verses:";  print_r($verse_stream[0]);  echo "'></p>";}
 for ($i = 1; $i <= $verse_stream[0]; $i++)
   {
    $bookcode=$verse_stream[$i][$book_index];
    $shortbook=show_book($bookcode);
    $ch=$verse_stream[$i][$ch_index];
    $vr=$verse_stream[$i][$vr_index];
    $cit=$shortbook."".$ch.":".$vr;
    $hebcitation= '('. hebrewize($bookcode,$ch , $vr) . ')';
    $key=$verse_stream[$i][$keyvalue_index];
        
    $citurl="<a target = '_blank' href='https://hatanach.geulah.org.il/verse/?verse=".$cit."'/>(".$cit.")</a>";
    $hebciturl="<a target = '_blank' href='https://hatanach.geulah.org.il/verse/?verse=".$cit."'/>".$hebcitation."</a>";
    $keyurl="<a target = '_blank' href='https://hatanach.geulah.org.il/verse/?key=".$key."'/>VerseKey:".$key."</a>";

    $sedar=show_sedarim($key)[1];
    $verse=vprint(verse_get($key));

    //if ($debug_flag) {echo "<p debug='all_sedarim_verse:";  print_r(array($sedar,$cit,$key));  echo "'></p>";}
     if ($highlight_key == $key) {
         echo '<h2><p dir="rtl" lang="he" class="source-text-highlighted-area">';
         $high_engcit="(". $cit .")";
         $high_hebcit= $hebcitation;
         $high_pasuk=$verse;
         $high_url="https://hatanach.geulah.org.il/verse/?verse=" . $cit;
        } else {
         echo '<h2><p dir="rtl" lang="he" class="source-text-area">';
        }


     if ($heb_citation) {
         echo $hebcitation;
     }
     echo $verse."</br>".PHP_EOL;

     if ($sedarim_citation) {
         $b1=show_book($sedar[3],2);
         $b2=show_book($sedar[3],4);
         //if ($debug_flag) {echo "<p debug='all_sedarim_verse sedarim_citation:";  print_r(array($b1,$b2));  echo "'></p>";}
         if (!($show_entire_sedar))
         { if ($b1 == $b2) { $sed_cit="[ספר:".$b2;}
          else
            {$sed_cit="[ספר:(".$b1.") ".$b2;}
            $sed_cit=$sed_cit. " סדר:".number2hebrew($sedar[1]);
            echo $sed_cit. " פיסקה:".number2hebrew($sedar[2])."]</br>".PHP_EOL;}
         else {echo "[פיסקה:".number2hebrew($sedar[2])."]</br>";}

     }
     if ($citation_url) {echo $citurl."</br>".PHP_EOL;}
     if ($hebcitation_url) {echo $hebciturl."</br>".PHP_EOL;}
     if ($key_url) {echo $keyurl."</br>".PHP_EOL;}
     echo  "</p></h2>". PHP_EOL;

     if ($comment_display) {$result=show_extra($key,html,'comment','<p dir="ltr" lang="en">The Letteris\'s Comments are:</p>','keyvalue');  echo $result;}
     if ($editor_display) {$result=show_extra($key,html,'editornotes','<p dir="ltr" lang="eng">The Editor\'s Comments are:</p>','keyvalue');  echo $result;}
     if ($hebrew_display) {$result=show_extra($key,html,'hebrew','<p dir="ltr" lang="en">The Hebrew Translation is:</p>','id');  echo $result;}
   }
}
?>
