<?php
include_once __DIR__ . "/general.php";
include_once __DIR__ . "/acv.php";
include_once __DIR__ . "/calls.php";
include_once __DIR__ . "/verse_get.php";


global $_debug_string; $_debug_string="";
global $block_format; $block_format=false;
global $buttons; $buttons=true;
global $cit; $cit=null;
global $cit_call; $cit_call=false;
global $citation_url; $citation_url=false;
global $colored_call; $colored_call=false;
global $comment_display;  $comment_display=false;
global $debug_flag; $debug_flag=false;
global $editor_display; $editor_display=false;
global $engraving_display; $engraving_display=false;
global $heb_citation; $heb_citation=false;
global $hebcitation_url; $hebcitation_url=false;
global $highlight; $highlight=null;
global $highlight_call; $highlight_call=false;
global $key; $key=null;
global $key_call; $key_call=false;
global $key_url; $key_url=false;
global $push_buttons; $push_buttons=true;
global $random_call; $random_call=false;
global $savedchoices; $savedchoices="";
global $sedarim_citation; $sedarim_citation=false;
global $text_only; $text_only=false;
global $translit_call; $translit_call=false;
global $tweet_display; $tweet_display=false;


foreach($_GET as $var => $value){
  $var=strtolower($var);
  $value=htmlspecialchars($value);
  switch($var){
  case "key":
      //if ($debug_flag) {echo "<p debug='key called:";  print_r($value);  echo "'></p>";}
      if (number_check($value)) {
      if (($value > 232130) || ($value < 10)) {
            echo "KEY used but number out of range";          
      } else {
         $key=$value;
         $key_call=true;
     }} else {
         echo "key needs value from 10 to 232130"; 
     }
     break;
 case "cit":
 case "citation":
 case "verse":
      if ((strlen($value) < 2)) {
           echo "cit size to small";
     } else {
         if (is_numeric($value))
          {
              //   if ($debug_flag) {echo "<p debug='cit really key:"; echo "'></p>";} 
             $key_call=true;
             $key=$value;
          }
          else
          {
            $cit=$value;
            $cit_call=true;
          }
      }
      break;
  case "highlight":
  case "high":
      //if ($debug_flag) {echo "<p debug='highlight called:";  print_r($value);  echo "'></p>";}
         if (number_check($value)) {
         if (($value > 900) || ($value < 1)) {
             echo "HIGHLIGHT used but number out of range";
         }  else {
             $highlight=$value;
             $highlight_call=true;
         }} else {
            echo "HIGHLIGHT used but not number";
         }
       break;
  case "random":  
      if (number_check($value)) {echo "random gets no seed $value ignored";}
      $random_call=true;
      break;
  case "colored": $colored_call = true; $savedchoices=$savedchoices. "&colored";  break;
  case "translit": $translit_call = true; $savedchoices=$savedchoices. "&translit";  break;
  case "text":
  case "text_only":  $text_only = true; $savedchoices=$savedchoices. "&text"; break;
  case "block": $block_format = true;  $savedchoices=$savedchoices. "&block"; break;
 # companies added to our URL
  case "fbaid": break;#facebook was here
  case "fbclid": break;#facebook was here
  case "mc_cid": break;#mailchimp was here
  case "_hs*": break;#hubspot was here
  case "gclid": break;#google ad
  case "li_fat_id": break;#linkedin
  case "utm_*": break;#click info source,medium,campaign,content,term
#api
  case "random_call": break; #$random_call=true; break;
  case "debug": $debug_flag=true; break;
  case "debug_flag": $debug_flag=true; break;
  case "key_call": $key_call=true; break;
  case "cit_call": $cit_call=true; break;
  case "highlight_call": $highlight_call=true; break;
  case "date": $fech_date = date('l jS \of F Y h:i:s A',filter_var($value,FILTER_VALIDATE_INT)); break;
  case "buttons": $buttons = (!empty($value) ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : true); break;
  case "push_buttons": $push_buttons = (!empty($value) ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : true); break;
  case "heb_citation": $heb_citation = (!empty($value) ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : true); break;
  case "sedarim_citation": $sedarim_citation = (!empty($value) ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : true); break;
  case "hebcitation_url": $hebcitation_url = (!empty($value) ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : true); break;
  case "key_url": $key_url = (!empty($value) ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : true); break;
  case "citation_url": $citation_url = (!empty($value) ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : true); break;
  case "comment_display": $comment_display = (!empty($value) ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : true); break;
  case "editor_display": $editor_display = (!empty($value) ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : true); break;
  case "hebrew_display": $hebrew_display = (!empty($value) ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : true); break;
  case "tweet": $tweet_display = (!empty($value) ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : true); break;
  case "engrave": $engraving_display = (!empty($value) ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : true); break;
  default: echo "unknown api call " . $var. " : " . $value."<br>".PHP_EOL; break;
  }
}

//begin set cookies
if (!empty($debug_flag) ){ addme("debug_flag",$debug_flag) ;} 
if (!empty($key_call) ){ addme("key_call",$key_call) ;} 
if (!empty($random_call) ){ addme("random_call",$random_call) ;} 
if (!empty($cit_call) ){ addme("cit_call",$cit_call) ;} 
if (!empty($highlight_call) ){ addme("highlight_call",$highlight_call) ;} 
if (!empty($key) ){ addme("key",$key) ;} 
if (!empty($highlight) ){ addme("highlight",$highlight) ;} 
if (!empty($cit) ){ addme("cit",$cit) ;} if (!empty($heb_citation) ){ addme("heb_citation",$heb_citation) ;} 
if (!empty($sedarim_citation) ){ addme("sedarim_citation",$sedarim_citation) ;} 
if (!empty($hebcitation_url) ){ addme("hebcitation_url",$hebcitation_url) ;} 
if (!empty($key_url) ){ addme("key_url",$key_url) ;} 
if (!empty($citation_url) ){ addme("citation_url",$citation_url) ;} 
if (!empty($comment_display) ){ addme("comment_display",$comment_display) ;} 
if (!empty($editor_display) ){ addme("editor_display",$editor_display) ;} 
if (!empty($hebrew_display) ){ addme("hebrew_display",$hebrew_display) ;}
if (!empty($colored_call) ){ addme("colored_call",$colored_call) ;}
if (!empty($tweet_display) ){ addme("tweet_display",$tweet_display) ;}
if (!empty($engraving_display) ){ addme("engraving_display",$engraving_display) ;}
if (!empty($buttons) ){ addme("buttons",$buttons) ;}
if (!empty($push_buttons) ){ addme("push_buttons",$push_buttons) ;}
//if (!empty($) ){ addme("",$) ;}
//end set cookies

$_debug_string="<p debug='after set cookies flags called:".dump_variables(get_defined_vars())."'></p>";
