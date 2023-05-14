<?php
function text_only($text){
    echo $text;
}

function text_header(){
?>
<!DOCTYPE html>
<html dir="rtl" lang="he">
<head>
<style>
@font-face{
    font-family: 'Noto Serif Hebrew', serif;
    font-weight: bold;
    font-size: 5em;
    color:#fff;
}
body { height: 100%; margin: 0; padding: 0; }
html { height: 100%; }
#box { background-color: #000; width: 100%; min-height: 100%; margin: auto; }
#title {font-family: 'Noto Serif Hebrew', serif; color: #fff; text-align: center; font-size: 100px; text-shadow: 3px 3px 0px #ff00bb, 5px 5px 0px #FFee00; display: flex; justify-content: center; align-items: center; height: 100vh; }
</style>
</head>
<body>
<div id="box"> box
  <div id="title">
<?PHP
}

function text_output($cit,$text){
?>
<!DOCTYPE html>
<html dir="rtl" lang="he">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style>
@font-face{
    font-family: 'Noto Serif Hebrew', serif;
    font-weight: bold;
    font-size: 5em;
    color:#fff;
}
#citation { font-size: 33%; text-shadow: none}
body { height: 100%; margin: 0; padding: 0; }
html { height: 100%; }
#center {
  margin: auto;
  width: 50%;
  padding: 10px;
}
#box { background-color: #000; width: 100%; min-height: 100%; margin: auto;}
#title {font-family: 'Noto Serif Hebrew', serif; color: #fff; text-align: center; font-size: 100px; text-shadow: 3px 3px 0px #ff00bb, 5px 5px 0px #FFee00; display: flex; justify-content: center; align-items: center; height: 100vh; }
@media screen and (min-width: 1000px) {   
    .mobileShow {   
       display: none   
    }   
  }   
</style>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js">   </script> 
 <script> 
	// User-defined function to share some message on WhatsApp 
	function share() { 
	    // collet the user input 
	   var message = $("input[name=message]").val(); 
                // JavaScript function to open URL in new window 
	    window.open( "whatsapp://send?text=" + message, '_blank'); 
	} 
    </script> 
</head> 

<body>
    <div id="box"> 
    <div id="title">
    <?PHP
    echo $text;
    echo "<h1 id='citation'>(".$cit.")</h1><br>";
    echo '</div>';
    echo '<div id="center">';
   
    $target="https://hatanach.geulah.org.il/verse/?";
    $kstring = $target. "cit=".$cit;
    $c="whatsapp://send?text=".$text." ".$kstring;
    echo '<input class="mobileShow" type="text" name="message" value="'.$kstring.'">';
    echo '<button onclick="share()" class="mobileShow"> Share to WhatsApp </button>';
    echo '</div>';
    echo '</div>';
}
