<?PHP
const NOTE_NAMES = array(
  'C', 'C#/Db', 'D', 'D#/Eb', 'E', 'F', 'F#/Gb', 'G', 'G#/Ab', 'A', 'A#/Bb', 'B'
);

const SCALE_DATA = array(
  'major' => array(
    'intervals' => array(2, 2, 1, 2, 2, 2, 1)
  ),
  'minor' => array(
    'intervals' => array(2, 1, 2, 2, 1, 2, 2)
  ),
  'pentatonic_major' => array(
    'intervals' => array(2, 2, 3, 2)
  ),
  'pentatonic_minor' => array(
    'intervals' => array(3, 2, 2, 3)
  )
);

function make_me_a_scale($tonic, $scale_name) {
  // Get the pitch class of the tonic.
  $pitch_class = get_pitch_class($tonic);

  // Get the intervals of the scale.
  $intervals = get_scale_intervals($scale_name);

  // Create an array of notes.
  $notes = array();
  for ($i = 0; $i < 12; $i++) {
    $notes[] = get_note($pitch_class + $intervals[$i]);
  }

  // Return the array of notes.
  return $notes;
}

// Get the pitch class of a note.
function get_pitch_class($note) {
  // Convert the note to uppercase.
  $note = strtoupper($note);

  // Get the position of the note in the alphabet.
  $position = array_search($note, NOTE_NAMES);

  // Return the pitch class.
  return $position + 1;
}

// Get the intervals of a scale.
function get_scale_intervals($scale_name) {
  // Get the scale data.
  $scale_data = SCALE_DATA[$scale_name];

  // Return the intervals.
  return $scale_data['intervals'];
}

// Get the note name for a pitch class.
function get_note($pitch_class) {
  // Get the note name from the note table.
  $note_name = NOTE_NAMES[$pitch_class];

  // Return the note name.
  return $note_name;
}
