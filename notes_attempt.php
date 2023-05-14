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




function make_me_a_scale_gpt4($tonic, $scale_name) {
    $notes = array("C", "C#", "D", "D#", "E", "F", "F#", "G", "G#", "A", "A#", "B");
    $scales = array(
         "CMajor" => array(0, 2, 4, 5, 7, 9, 11),
         "EMinor" => array(4, 5, 7, 8, 10, 11),
         "GMajor" => array(0, 2, 4, 5, 7, 9, 11),
         "AMinor" => array(4, 5, 7, 8, 10)
    );
    $tonic_index = array_search($tonic, $notes);
    $scale = $scales[$scale_name];
    $result = array();
    for ($i = -4; $i <= 8; $i++) {
        $note_index = ($tonic_index + $scale[($i + count($scale)) % count($scale)]) % count($notes);
        if ($i < -1) {
            // Add a ' tag to lower notes
            $result[(string)$i] = $notes[$note_index] . "'";
        } elseif ($i > 6) {
            // Use lowercase letters for higher notes
            $result[(string)$i] = strtolower($notes[$note_index]);
        } else {
            $result[(string)$i] = $notes[$note_index];
        }
    }
    return $result;
}


function make_me_a_scale_gpt31($tonic, $scale_name) {
  // Define the intervals for each type of scale
  $scales = array(
    "major" => array(0, 2, 4, 5, 7, 9, 11),
    "minor" => array(0, 2, 3, 5, 7, 8, 10),
    "dorian" => array(0, 2, 3, 5, 7, 9, 10),
    "mixolydian" => array(0, 2, 4, 5, 7, 9, 10),
    // add more scales here if needed
  );
  
  // Get the intervals for the specified scale
  $intervals = $scales[$scale_name];
  
  // Get the MIDI note number for the tonic
  $tonic_num = intval((ord(strtolower($tonic)) - ord('a')) / 2) + 12 * (-4);

  // Generate the array of notes
  $notes = array();
  foreach ($intervals as $interval) {
    $note_num = $tonic_num + $interval;
    $note_letter = chr(97 + ($note_num % 12) * 2);
    $note_octave = intval($note_num / 12);
    $notes[] = $note_letter . "," . $note_octave;
  }
  
  return $notes;
}



function make_me_a_scale_gpt32($tonic, $scale_name) {
  // Define the intervals for each type of scale
  $scales = array(
    "major" => array(0, 2, 4, 5, 7, 9, 11),
    "minor" => array(0, 2, 3, 5, 7, 8, 10),
    "dorian" => array(0, 2, 3, 5, 7, 9, 10),
    "mixolydian" => array(0, 2, 4, 5, 7, 9, 10),
    // add more scales here if needed
  );
  
  // Get the intervals for the specified scale
  $intervals = $scales[$scale_name];
  
  // Get the MIDI note number for the tonic
  $tonic_num = intval((ord(strtolower($tonic)) - ord('a')) / 2) + 12 * (-4);

  // Generate the array of notes
  $notes = array();
  foreach ($intervals as $interval) {
    $note_num = $tonic_num + $interval;
    $note_letter = chr(97 + ($note_num % 12) * 2);
    $note_octave = intval($note_num / 12) - 1;
    $notes[] = $note_letter . '.' . $note_octave;
  }
  
  return $notes;
}

function make_me_a_scale_gpt_33($tonic, $scale_name) {
  // Define the intervals for each type of scale
  $scales = array(
    "major" => array(0, 2, 4, 5, 7, 9, 11),
    "minor" => array(0, 2, 3, 5, 7, 8, 10),
    "dorian" => array(0, 2, 3, 5, 7, 9, 10),
    "mixolydian" => array(0, 2, 4, 5, 7, 9, 10),
    // add more scales here if needed
  );
  
  // Get the intervals for the specified scale
  $intervals = $scales[$scale_name];
  
  // Get the MIDI note number for the tonic
  $tonic_num = intval((ord(strtolower($tonic)) - ord('a')) / 2) + 12 * (-4);

  // Generate the array of notes
  $notes = array();
  foreach ($intervals as $interval) {
    $note_num = $tonic_num + $interval;
    $note_letter = chr(97 + ($note_num % 12) * 2);
    $note_octave = intval($note_num / 12) - 4;
    $note = $note_letter . "," . $note_octave . ",";
    $notes[] = $note;
  }
  
  return $notes;
}

function make_me_a_scale($tonic, $scale_name) {
  // Get the scale intervals for the given scale name.
  $intervals = get_scale_intervals($scale_name);

  // Create an array to store the notes in the scale.
  $notes = array();

  // Add the tonic note to the array.
  $notes[] = $tonic;

  // Iterate through the scale intervals and add the notes to the array.
  for ($i = 0; $i < 12; $i++) {
    $notes[] = $tonic + $intervals[$i];
  }

  // Return the array of notes.
  return $notes;
}

// Get the scale intervals for a given scale name.
function get_scale_intervals($scale_name) {
  switch ($scale_name) {
    case "major":
      return array(2, 2, 1, 2, 2, 2, 1);
    case "minor":
      return array(2, 1, 2, 2, 1, 2, 2);
    case "pentatonic":
      return array(2, 2, 3, 2, 3);
  }

  // Invalid scale name.
  return null;
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


