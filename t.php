<?PHP
include __DIR__ . "/header.php";
include __DIR__ . "/random_key.php";
include_once __DIR__ . "/acv.php";
include_once __DIR__ . "/all_sedarim_verse.php";
include_once __DIR__ . "/booklookup.php";
include_once __DIR__ . "/button_wrap.php";
include_once __DIR__ . "/calls.php";
include_once __DIR__ . "/cit_next_previous.php";
include_once __DIR__ . "/cit_push_buttons.php";
include_once __DIR__ . "/convertor.php";
include_once __DIR__ . "/db_call.php";
include_once __DIR__ . "/eng_verse.php";
include_once __DIR__ . "/fix_peh_samach.php";
include_once __DIR__ . "/gematria.php";
include_once __DIR__ . "/general.php";
include_once __DIR__ . "/hebrewize.php";
include_once __DIR__ . "/next_previous.php";
include_once __DIR__ . "/publish_html.php";
include_once __DIR__ . "/push_buttons.php";
include_once __DIR__ . "/sedarim_verse.php";
include_once __DIR__ . "/show_extra.php";
include_once __DIR__ . "/show_sedarim.php";
include_once __DIR__ . "/show_transilation.php";
include_once __DIR__ . "/show_translit.php";
include_once __DIR__ . "/single_verse.php";
include_once __DIR__ . "/verse_get.php";


function not_block_output($text,$cit=""){
    echo '<div class="hidden" style="display: none;">';print_r(array($text,$cit,count(explode('(', $text)))); echo '</div>';
    if (substr_count($dv, ')') > 0){
        $sentences = explode('(', $text);
        echo '<h2><p dir="rtl" lang="he" class="source-text-area-title">'.$cit.'</p></h2>';
        foreach($sentences as $line => $sentence){
            if ($line > 0)
            {
                echo PHP_EOL.'<h2><p dir="rtl" lang="he" class="source-text-area">';
                echo '('.$sentence;
                echo '</p></h2>';
            }
        }
    } else echo PHP_EOL.'<h2><p dir="rtl" lang="he" class="source-text-area">'.$text.'</p></h2>';
}


$debug_flag=true;
$key=223510;
/*
$osis='Hos.14'; $high=0;
list($hebcit,$citarray,$url_output,$engcit)=acv($osis);
     $dv="";
        $o_vr=0;
        foreach ($citarray as $index => $word) {
            if (!($word['vr'] == $o_vr))
            {
                 if ($highlight) $dv.='</span>';
                 $dv.= " (".number2hebrew($word['vr']).")";
                 $o_vr = $word['vr'];
                 $highlight = $word['vr'] == $high;
                 if ($highlight) $dv.='<span class=source-text-highlighted-area>';
            }
            if ($word['reason']==0)
            {
                if ($index==0) $vr_start = $word['vr'];
                $dv.=" ".fix_peh_samach($word['word_ktiv'],false);
            }
        }
*/

 $pasuk=vprint(verse_get($key));
    // Remove everything in between the <span> tags, as well as the <span> tags themselves
    $cleanstring = preg_replace('/<span[^>]*>.*?<\/span>/', '', $pasuk);
    // Remove the <a> tag along with its brackets, and keep the text inside it
    $cleanstring = preg_replace('/<a[^>]*>(.*?)<\/a>/', '$1', $cleanstring);
    $cleanstring = fix_peh_samach($cleanstring,false);

echo not_block_output($cleanstring,"");



?>
</body></html>

