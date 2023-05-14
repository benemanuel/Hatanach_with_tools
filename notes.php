<?php
function scale_available($scale){
if (!defined('scales')) define('scales',array(  'AMinor',
     'BMinor',
     'CBlues',
     'CMajor',
     'CMinor',
     'CSharpMinor',
     'DMajor',
     'DMinor',
     'EMajor',
     'EMinor',
     'FMajor',
     'GMajor'
));
if ($scale == "?") return scales;
else return in_array($scale, scales);
}

function define_scale($scale='CMajor'){
if (!defined('AMinor')) define('AMinor',array("-4"=>"E", "-3"=>"F^", "-2"=>"G^", "-1"=>"A", "0"=>"B", "1"=>"C^", "2"=>"D^", "3"=>"E", "4"=>"F^", "5"=>"G^", "6"=>"A", "7"=>"b_", "8"=>"c^"));
if (!defined('CBlues'))    define('CBlues',array("-4"=>"G'", "-3"=>"E_", "-2"=>"F", "-1"=>"G_", "0"=>"G", "1"=>"B_", "2"=>"c", "3"=>"e_", "4"=>"f", "5"=>"g_", "6"=>"g", "7"=>"b_"));
if (!defined('CMajor'))    define('CMajor',array("-4"=>"F", "-3"=>"G", "-2"=>"A", "-1"=>"B", "0"=>"C", "1"=>"D", "2"=>"E", "3"=>"F", "4"=>"G", "5"=>"A", "6"=>"B", "7"=>"c", "8"=>"d"));
if (!defined('CMinor'))    define('CMinor',array("-4"=>"G'", "-3"=>"A_", "-2"=>"B_", "-1"=>"C", "0"=>"D", "1"=>"E_", "2"=>"F", "3"=>"G", "4"=>"A_", "5"=>"B_", "6"=>"c", "7"=>"d", "8"=>"e_"));
if (!defined('EMinor'))    define('EMinor',array("-4" =>"C^","-3" =>"D^","-2" =>"E","-1" =>"F^","0" =>"G^","1" =>"A","2" =>"B","3" =>"C^","4" =>"D^","5" =>"E","6" =>"F^","7" =>"g^","8" =>"a"));
if (!defined('GMajor'))    define('GMajor',array("-4"=>"D", "-3"=>"E", "-2"=>"F^", "-1"=>"G", "0"=>"A", "1"=>"B", "2"=>"C^", "3"=>"D", "4"=>"E", "5" =>"F^", "6" =>"G","7" =>"a","8" =>"b_"));
if (!defined('BMinor'))    define('BMinor',array("-4" =>"A","-3" =>"B","-2" =>"C^","-1" =>"D","0" =>"E","1" =>"F^","2" =>"G","3" =>"A","4" =>"B","5" =>"C^","6" =>"D","7" =>"e","8" =>"f^"));
if (!defined('CSharpMinor'))    define('CSharpMinor',array("-4"=>"B", "-3"=>"C^", "-2"=>"D^", "-1"=>"E", "0"=>"F^", "1"=>"G^", "2"=>"A", "3"=>"B", "4"=>"C^", "5" =>"D^", "6" =>"E","7" =>"f^","8" =>"g^"));
if (!defined('DMajor'))    define('DMajor',array("-4"=>"C^", "-3"=>"D", "-2"=>"E", "-1"=>"F^", "0"=>"G", "1"=>"A", "2"=>"B", "3"=>"C^", "4"=>"D", "5" =>"E", "6" =>"F^","7" =>"g","8" =>"a"));
if (!defined('DMinor'))    define('DMinor',array("-4"=>"B_", "-3"=>"C", "-2"=>"D", "-1"=>"E_", "0"=>"F", "1"=>"G", "2"=>"A", "3"=>"B_", "4"=>"C", "5"=>"D", "6"=>"E_", "7"=>"f", "8"=>"g"));
if (!defined('EMajor'))    define('EMajor',array("-4"=>"D^", "-3"=>"E", "-2"=>"F^", "-1"=>"G^", "0"=>"A", "1"=>"B", "2"=>"C^", "3"=>"D^", "4"=>"E", "5" =>"F^", "6" =>"G^","7" =>"a","8" =>"b"));
if (!defined('FMajor'))    define('FMajor',array("-4"=>"E_", "-3"=>"F", "-2"=>"G", "-1"=>"A", "0"=>"B_", "1"=>"C", "2"=>"D", "3"=>"E_", "4"=>"F", "5"=>"G", "6"=>"A", "7"=>"b_", "8"=>"c"));
    
    switch($scale) {
    case 'AMinor': $notes=AMinor; break;
    case 'BMinor': $notes=BMinor; break;
    case 'CBlues': $notes=CBlues; break;
    case 'CMajor': $notes=CMajor; break;
    case 'CMinor': $notes=CMinor; break;
    case 'CSharpMinor': $notes=CSharpMinor; break;
    case 'DMajor': $notes=DMajor; break;
    case 'DMinor': $notes=DMinor; break;
    case 'EMajor': $notes=EMajor; break;
    case 'EMinor': $notes=EMinor; break;
    case 'FMajor': $notes=FMajor; break;
    case 'GMajor': $notes=GMajor; break;
    default: $notes=CMajor; break;
    }
    return $notes;
}



function make_me_a_scale(string $tonic, string $scale_name): array {
    $pitches = [
        'C' => 0,
        'C#' => 1,
        'D' => 2,
        'D#' => 3,
        'E' => 4,
        'F' => 5,
        'F#' => 6,
        'G' => 7,
        'G#' => 8,
        'A' => 9,
        'A#' => 10,
        'B' => 11,
    ];
    
    $intervals = [
        'major' => [0, 2, 4, 5, 7, 9, 11],
        'minor' => [0, 2, 3, 5, 7, 8, 10],
        // add more scales as needed
    ];
    
    $tonic_pitch = $pitches[$tonic];
    $scale_intervals = $intervals[$scale_name];
    
    $scale = [];
    for ($i = -4; $i <= 8; $i++) {
        $index = ($i % count($scale_intervals) + count($scale_intervals)) % count($scale_intervals);
        $pitch_class = ($tonic_pitch + $scale_intervals[$index]) % 12;
        $scale[$i] = $pitch_class;
    }
    
    return $scale;
}



function compare_scales($scale){
    echo $scale."<br>".PHP_EOL;

    foreach (define_scale($scale) as $note_index => $note) {
        echo $note_index.",".$note.",";
    }
    echo "<br>".PHP_EOL;

    foreach (make_me_a_scale('C', $scale)  as $note_index => $note) {
        echo $note_index.",".$note.",";
    }
    echo "<br>".PHP_EOL;

    foreach (make_me_a_scale4('C', $scale)  as $note_index => $note) {
        echo $note_index.",".$note.",";
    }
    echo "<br>".PHP_EOL;
    echo "</p>";
}

//echo "<p dir=ltr>".PHP_EOL;
//foreach (scale_available('?') as $index => $scale) {
    /*    echo $scale.",";
    foreach (define_scale($scale) as $note_index => $note) {
        echo $note_index.",".$note.",";
    }
    echo "<br>".PHP_EOL;
    */
//    compare_scales($scale);
//}
//echo "</p>";


