<?php
include __DIR__ . "/urlstart.php";
#from this point on HTML

if (!$text_only) {
    include __DIR__ . "/header.php";
    echo $_debug_string.PHP_EOL;
    $_debug_string="";
}
    
if ($debug_flag) {
    echo "<p debug='flags called:";
    echo PHP_EOL."cit_call= "; echo ($cit_call)? "true [".$cit."] ". strlen($cit) :"false";
    echo PHP_EOL."random_call= "; echo ($random_call)? "true [".$key."] " :"false";
    echo PHP_EOL."key_call= "; echo ($key_call)? "true [".$key."] " :"false";   
    echo PHP_EOL."highlight_call= "; echo ($highlight_call)? "true [".$highlight."] " :"false";
    echo PHP_EOL."var= "; echo ($d);
    echo "'></p>";
}


/*if ($random_call && ($cit_call))
  {
      echo "can't use random with cit";
      }*/
if ($random_call) {$cit_call = true;} #all random calls are infact a key call

if (!($cit_call || $key_call))
     {
        echo "verse value not set, enter 'key?' number from 10-232130 or 'cit?' BookChap:Verse";
     }

include_once __DIR__ . "/convertor.php";
include_once __DIR__ . "/acv.php";
include_once __DIR__ . "/calls.php";

if ($random_call)//what about other url choices? seems ignored
    {
      include __DIR__ . "/random_key.php";
      $key = random_key();
      //GoToNow(clean_url(). "?key=". random_key(). $savedchoices);
      $cit=convertor($key);
      GoToNow(clean_url(). "?cit=". $cit . $savedchoices);
    }


if ($key_call)
{
    if (strlen($cit)>0)
 {
    $cit.=",".convertor($key);
 }else{
    $cit=convertor($key);
 }
}

if ($debug_flag)
{
    echo "<p debug='after flags called:";
    echo PHP_EOL."cit_call= "; echo ($cit_call)? "true [".$cit."] ". strlen($cit) :"false";
    echo PHP_EOL."random_call= "; echo ($random_call)? "true [".$key."] " :"false";
    echo PHP_EOL."key_call= "; echo ($key_call)? "true [".$key."] " :"false";   
    echo PHP_EOL."highlight_call= "; echo ($highlight_call)? "true [".$highlight."] " :"false";
    echo PHP_EOL."cit len= "; echo strlen($cit);
    echo "'></p>";
}


if ($cit_call)//strlen($cit)>0)
{
    $k_key=convertor(0,$cit);
    //if ($highlight_call){echo 'highlight_call '.$highlight;}
    citation_call($cit,$highlight);
    if (is_numeric($k_key))
    {
      echo PHP_EOL."<br><details>";
      if (!empty($fech_date)) {
          echo "<date>";
          echo (is_numeric($fech_date))?  date('l jS \of F Y h:i:s A',$fech_date) : $fech_date;
          echo "</date>";
      }
      $target="https://hatanach.geulah.org.il/verse/?";
      $kstring = "<br><a target = '_blank' href='".$target ."key=". $k_key . "'/>verse</a>";          

      if (!$text_only) {
          echo "<summary>Pasuk direct link</summary>";
          echo $kstring;
      }
      else {
          echo "<summary>Links</summary>";
          echo "<date>";
          echo (is_numeric($date))?  date('l jS \of F Y h:i:s A',$date) : $date;
          echo "</date>";

          // $kstring = 
                   $target. "cit=".$cit;
          $c="whatsapp://send?text=".$kstring;
          //echo '<button onclick="window.open('.$c.')">XhatsApp </button>';
          echo ' <input class="mobileShow" type="text" name="message" value="'.$kstring.'">';
          echo '<button onclick="share()" class="mobileShow"> Share to WhatsApp </button>';

          //$c="whatsapp://send?text=".$kstring;
          //echo '<button onclick="window.open($c)"> WhatsApp </button>';

          //echo '<input class="mobileShow" type="text" name="message">';
          //echo '<button onclick="share()" class="mobileShow"> Share to WhatsApp </button>';   
          //  echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"> </script>';   
          //echo '<script>';   
          //echo 'function share() {';
          //echo '    var message = $("input[name=message]").val();   ';
          //echo '    window.open( "whatsapp://send?text=" + message, '."'_blank'".');';   
          //echo '}';
          //echo '</script>'; 
      }
      echo "<br><a target = '_blank' href='". $_SERVER['REQUEST_URI'] . "'/>cit url</a>";
      echo "</details>".PHP_EOL;
    } else {
       if ($debug_flag)
        {
         echo "<p debug='not numeric ?range? cit:";
         print_r($cit);
         echo "k:";print_r($k);
         echo "'></p>";
        }
    }
}
//echo PHP_EOL."<p debug='check key call'></p>";
if ($key_call)
{
   echo '<br>'.PHP_EOL;
   key_like_call($key);
   if (!empty($fech_date)) {print_details($key,$fech_date);}
   else {print_details($key);}
   echo '<br>'.PHP_EOL;
}

if ($colored_call)
{echo '<script src="../script/colorme.js"></script>'.PHP_EOL;}
if ($translit_call)
{echo '<script src="../script/sourcetranslitme.js"></script>'.PHP_EOL;}

if (!$text_only) echo PHP_EOL.'</body></html>';
else echo '</div></div>'.PHP_EOL.'</body></html>'; 
?>
