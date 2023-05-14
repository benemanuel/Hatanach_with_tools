<?PHP
function make_me_a_scale($tonic, $scale_name) {
    $notes = array("C", "C#", "D", "D#", "E", "F", "F#", "G", "G#", "A", "A#", "B");
    $scales = array(
        "Cmajor" => array(0, 2, 4, 5, 7, 9, 11),
        "EMinor" => array(4, 5, 7, 8, 10, 11),
        "Gmajor" => array(0, 2, 4, 5, 7, 9, 11),
        "Aminor" => array(4, 5, 7, 8, 10)
    );
    $tonic_index = array_search($tonic, $notes);
    $scale = $scales[$scale_name];
    $result = array();
    for ($i = -4; $i <= 8; $i++) {
        $note_index = ($tonic_index + $scale[($i + count($scale)) % count($scale)]) % count($notes);
        $result[(string)$i] = $notes[$note_index];
    }
    return $result;
}
