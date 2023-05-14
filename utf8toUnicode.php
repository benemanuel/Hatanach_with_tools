<?php
function utf8toUnicode($str){
  $unicode = "";
  $len = mb_strlen($str);
  for($i=0;$i<$len;$i++){
    $utf8char = mb_substr($str,$i,1);
    $unicode .= strlen($utf8char)>1
      ?trim(json_encode($utf8char),'"')
      :('\\u00'.bin2hex($utf8char))
    ;
  }
  return $unicode;
} 
