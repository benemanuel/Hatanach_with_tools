<?PHP
function td($str){
     return  "<td>" .$str. "</td>";
    //return  "," .$str;
}
function make_me_a_scale(string $tonic, string $scale_name): array {
    $pitches = [
        'C' => 0,
        'C♯' => 1,
        'D' => 2,
        'D♯' => 3,
        'E' => 4,
        'F' => 5,
        'F♯' => 6,
        'G' => 7,
        'G♯' => 8,
        'A' => 9,
        'A♯' => 10,
        'B' => 11,
    ];

    //The accenting of the scale in Helmholtz notation always starts on the note C and ends at B (e.g. C D E F G A B). The note C is shown in different octaves by using upper-case letters for low notes, and lower-case letters for high notes, and adding sub-primes and primes in the following sequence: C͵͵ C͵ C c c′ c″ c‴). Index 0 starts as a capital C

    $octave_signature = array (
        'uppercase' =>  array (
        -4 => true,
        -3 => true,
        -2 => true,
        -1 => true,
        0 => true,
        1 => false,
        2 => false,
        3 => false,
        4 => false,
        5 => false
        ),
        'octavesign' =>  array (
        -4 => ",,,,",
        -3 => ",,,",
        -2 => ",,",
        -1 => ',',
        0 => '',
        1 => '',
        2 => "′",
        3 => '″',
        4 => "‴",
        5 => '⁗'
        )
    );

    if (!defined('octavesign')) define('octavesign','octavesign');
    if (!defined('uppercase')) define('uppercase','uppercase');
    if (!defined('sharp')) define('sharp','♯');
    if (!defined('flat')) define('flat','♭');
    if (!defined('natual')) define('natual','♮');


    $intervals = [
        'major' => [0, 2, 4, 5, 7, 9, 11],
        'minor' => [0, 2, 3, 5, 7, 8, 10],
        // add more scales as needed
    ];

    $tonic_pitch = $pitches[$tonic];
    $scale_intervals = $intervals[$scale_name];

    $scale = [];
    //for ($i = -24; $i <= 24; $i++) {
    for ($i = -4; $i <= 15; $i++) {
        $index = ($i % count($scale_intervals) + count($scale_intervals)) % count($scale_intervals);
        $pitch_class = ($tonic_pitch + $scale_intervals[$index]) % 12;
        $octave = (floor(($i + $tonic_pitch) / 12) - 1) + 1;
        $note = array_search($pitch_class, $pitches);
        $scale[$i] = td($note) . td($octave); //this gives similar to Scientific pitch notation but with -1 at the tonic
        if ($octave_signature[uppercase][$octave])  {$scale[$i] .= td($note . $octave_signature[octavesign][$octave]);}
        else $scale[$i] .= td(strtolower($note) . $octave_signature[octavesign][$octave]);
    }

    return $scale;
}



$notes = make_me_a_scale('C', 'major');
//include "header.php";
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../css/SBLHebrew-webfont.css" type="text/css">
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
<style>
table, th, td {
  border:1px solid black;
}
</style>
</head>
<body>
<?PHP
echo '<table  class="source-text-area" dir="ltr">';
echo '<tr><th>index</th><th>note</th><th>octave</th><th>signed</th></tr>';
foreach($notes as $index => $note)
{
    echo "<tr>";
    echo td($index).$note;//    echo td($index).print_r($note).PHP_EOL;
    echo "</tr>".PHP_EOL;
}
echo "</table></body></html>";
#C;-1;C,0;1
