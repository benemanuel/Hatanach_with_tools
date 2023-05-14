<?PHP
function abc_editor_top ($output=null,$heading='Test')
{
if (!isset($output)){
    $output = fopen('php://output', 'w');
    fwrite($output,'localoutput:'.PHP_EOL);
}

fwrite($output,'<!DOCTYPE HTML>'.PHP_EOL);
fwrite($output,'<html dir="ltr" lang="en">'.PHP_EOL);
fwrite($output,'<head>'.PHP_EOL);
fwrite($output,"	<meta charset='utf-8'>".PHP_EOL);
fwrite($output,'	<meta http-equiv="content-type" content="text/html" />'.PHP_EOL);
fwrite($output,'	<meta name="viewport" content="width=device-width, initial-scale=1.0">'.PHP_EOL);
fwrite($output,'	<link rel="icon" href="favicon.ico" type="image/x-icon"/>'.PHP_EOL);
fwrite($output,'	<title>'.$heading.'</title>'.PHP_EOL);
fwrite($output,''.PHP_EOL);
fwrite($output,'	<link href="/css/abcjs-audio.css" media="all" rel="stylesheet" type="text/css" />'.PHP_EOL);
fwrite($output,'	<script src="/script/abcjs-basic-min.js" type="text/javascript"></script>'.PHP_EOL);
fwrite($output,'	<style>'.PHP_EOL);
fwrite($output,'		.abcjs-inline-audio {'.PHP_EOL);
fwrite($output,'			max-width: 770px;'.PHP_EOL);
fwrite($output,'		}'.PHP_EOL);
fwrite($output,'	  @media print {'.PHP_EOL);
fwrite($output,'			h1, p, textarea, #selection, #audio, #warnings, hr {'.PHP_EOL);
fwrite($output,'				display: none;'.PHP_EOL);
fwrite($output,'			}'.PHP_EOL);
fwrite($output,'		}'.PHP_EOL);
fwrite($output,'		p {'.PHP_EOL);
fwrite($output,'			max-width: 600px;'.PHP_EOL);
fwrite($output,'		}'.PHP_EOL);
fwrite($output,'	</style>'.PHP_EOL);
fwrite($output,'</head>'.PHP_EOL);
fwrite($output,'<body>'.PHP_EOL);
fwrite($output,'<h1>'.$heading.'</h1>'.PHP_EOL);
fwrite($output,''.PHP_EOL);
fwrite($output,'<textarea name="abc" id="abc" cols="80" rows="15">'.PHP_EOL);
fwrite($output,'%abc-2.1'.PHP_EOL);
fwrite($output,'%%pagewidth      21cm'.PHP_EOL);
fwrite($output,'%%pageheight     29.7cm'.PHP_EOL);
fwrite($output,'%%topspace       0.5cm'.PHP_EOL);
fwrite($output,'%%topmargin      1cm'.PHP_EOL);
fwrite($output,'%%botmargin      0cm'.PHP_EOL);
fwrite($output,'%%leftmargin     1cm'.PHP_EOL);
fwrite($output,'%%rightmargin    1cm'.PHP_EOL);
fwrite($output,'%%titlespace     0cm'.PHP_EOL);
fwrite($output,'%%titlefont      Times-Bold 32'.PHP_EOL);
fwrite($output,'%%subtitlefont   Times-Bold 24'.PHP_EOL);
fwrite($output,'%%composerfont   Times 16'.PHP_EOL);
fwrite($output,'%%vocalfont      Times-Roman 14'.PHP_EOL);
fwrite($output,'%%staffsep       60pt'.PHP_EOL);
fwrite($output,'%%sysstaffsep    20pt'.PHP_EOL);
fwrite($output,'%%musicspace     1cm'.PHP_EOL);
fwrite($output,'%%vocalspace     5pt'.PHP_EOL);
fwrite($output,'%%measurenb      0'.PHP_EOL);
fwrite($output,'%%barsperstaff   5'.PHP_EOL);
fwrite($output,'%%scale          0.7'.PHP_EOL);
fwrite($output,'X:1'.PHP_EOL);
}

function abc_editor_bottom ($output=null)
{
if (!isset($output))
{ $output = fopen('php://output', 'w');}
fwrite($output,'</textarea>'.PHP_EOL);
fwrite($output,''.PHP_EOL);
fwrite($output,'<hr />'.PHP_EOL);
fwrite($output,'<div id="audio"></div>'.PHP_EOL);
fwrite($output,'<div id="warnings"></div>'.PHP_EOL);
fwrite($output,'<div id="paper0" class="paper"></div>'.PHP_EOL);
fwrite($output,'<div id="paper1" class="paper"></div>'.PHP_EOL);
fwrite($output,'<div id="paper2" class="paper"></div>'.PHP_EOL);
fwrite($output,'<div id="paper3" class="paper"></div>'.PHP_EOL);
fwrite($output,'<div id="selection"></div>'.PHP_EOL);
fwrite($output,''.PHP_EOL);
fwrite($output,'<script type="text/javascript">'.PHP_EOL);
fwrite($output,'	function selectionCallback(abcelem) {'.PHP_EOL);
fwrite($output,'		var note = {};'.PHP_EOL);
fwrite($output,'		for (var key in abcelem) {'.PHP_EOL);
fwrite($output,'			if (abcelem.hasOwnProperty(key) && key !== "abselem")'.PHP_EOL);
fwrite($output,'				note[key] = abcelem[key];'.PHP_EOL);
fwrite($output,'		}'.PHP_EOL);
fwrite($output,'		console.log(abcelem);'.PHP_EOL);
fwrite($output,'		var el = document.getElementById("selection");'.PHP_EOL);
fwrite($output,'		el.innerHTML = "<b>selectionCallback parameter:</b><br>" + JSON.stringify(note);'.PHP_EOL);
fwrite($output,'	}'.PHP_EOL);
fwrite($output,''.PHP_EOL);
fwrite($output,'	function initEditor() {'.PHP_EOL);
fwrite($output,'		new ABCJS.Editor("abc", { paper_id: "paper0",'.PHP_EOL);
fwrite($output,'			synth: {'.PHP_EOL);
fwrite($output,'				el: "#audio",'.PHP_EOL);
fwrite($output,'				options: { displayLoop: true, displayRestart: true, displayPlay: true, displayProgress: true, displayWarp: true }'.PHP_EOL);
fwrite($output,'			},'.PHP_EOL);
fwrite($output,'			generate_warnings: true,'.PHP_EOL);
fwrite($output,'			warnings_id:"warnings",'.PHP_EOL);
fwrite($output,'			abcjsParams: {'.PHP_EOL);
fwrite($output,'				generateDownload: true,'.PHP_EOL);
fwrite($output,'				clickListener: selectionCallback'.PHP_EOL);
fwrite($output,'			}'.PHP_EOL);
fwrite($output,'		});'.PHP_EOL);
fwrite($output,'	}'.PHP_EOL);
fwrite($output,''.PHP_EOL);
fwrite($output,'	window.addEventListener("load", initEditor, false);'.PHP_EOL);
fwrite($output,'</script>'.PHP_EOL);
fwrite($output,'</body></html>'.PHP_EOL);
}

function engrave_music($cit_string,$title2,$book,$melody,$hebrew_lyrics,$translit_lyrics,$title="")
{
    global $debug_flag;
    $debug_flag=true;
    if ($debug_flag) {
        echo "<p debug='engrave music".PHP_EOL;
        echo "hl="; print_r($hebrew_lyrics); echo PHP_EOL;
        echo "tl="; print_r($translit_lyrics); echo PHP_EOL;
        echo "m=";  print_r($melody); echo PHP_EOL;
        echo "'></p>";}
    echo '</body></html><html dir="ltr" lang="en">';
    echo "Publish Book:";
    if (!empty($cit_string)) //we have what to publish
    {
        $output =  "tmp/". $cit_string . ".html";
        $myfile = fopen($output, "w") or die("Unable to open file!");
        $BOM = "\xEF\xBB\xBF"; // UTF-8 BOM
        fwrite($myfile,$BOM);
        //$myfile = fopen($output, "w") or die("Unable to open file!");
        //$myfile = fopen('php://output', 'w'); //output handler

        abc_editor_top($myfile,$title);
        fwrite($myfile,'T: '.$title.PHP_EOL);
        fwrite($myfile,'T: '.$title2.PHP_EOL);
        fwrite($myfile,'C: '.$book.PHP_EOL);
        fwrite($myfile,'M: 4/4'.PHP_EOL);
        fwrite($myfile,'K: C'.PHP_EOL);
        fwrite($myfile,'Q:"Moderato"'.PHP_EOL);
        fwrite($myfile,'%%begintext align'.PHP_EOL.$cit_string.PHP_EOL.'%%endtext'.PHP_EOL);
        $m = explode(PHP_EOL, str_replace(",",' ',$melody));
        $h = explode("*", str_replace(",",'-',$hebrew_lyrics));
        $t = explode(PHP_EOL,  str_replace('--' ,"־ ",str_replace(",",'-',str_replace("\u05bd",'',$translit_lyrics))));
        //$h = explode("*", $hebrew_lyrics);
        //$t = explode(PHP_EOL, $translit_lyrics);
        /*if ((count($m) == count($h)) && (count($h) == count($t)))
        {
        */
        for($i = 0; ($i < count($m)); $i++)
        {
            if (array_key_exists($i,$h)) {$h1=$h[$i];} else $h1="";
            if (array_key_exists($i,$t)) {$t1=$t[$i];} else $t1="";
            fwrite($myfile,ltrim(rtrim($m[$i])).PHP_EOL);
            fwrite($myfile,'w: '.ltrim(rtrim($h1)).PHP_EOL);
            fwrite($myfile,'w: '.ltrim(rtrim($t1)).PHP_EOL);
        }
        /*} else
        {
            fwrite($myfile,$melody.PHP_EOL);
            fwrite($myfile,'w: '.$hebrew_lyrics.PHP_EOL);
            fwrite($myfile,'w: '.$translit_lyrics.PHP_EOL);
            }*/
        abc_editor_bottom($myfile);
        fclose($myfile);
        $file_name = "https://hatanach.geulah.org.il/verse/".$output;
        echo  "<a target = '_blank' href='https://hatanach.geulah.org.il/verse/".$output."'/>". $title."</a><br>";
        header("Location: $file_name");
        exit;
        $url = (($_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://". $_SERVER['HTTP_HOST'] . substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], "/"));
        echo "<br><a target = '_blank' href='".  $url . "/".$output. "'/>". $cit_string."</a>". PHP_EOL;
        /* echo '<script language="javascript">
           window.location.href = "'.$u2. '"
           </script>';
        */
        //echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $url .  "/".$output'">';
    } else { echo "no citation given".PHP_EOL;}
}
