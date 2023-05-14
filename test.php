<?PHP
include __DIR__ . "/header.php";
include __DIR__ . "/notes.php";
include_once __DIR__ . "/make_me_a_scale.php";

function compare($scale){
    echo "<br><br><p dir=ltr>".PHP_EOL;
    echo $scale."<br>".PHP_EOL;

    foreach (define_scale($scale) as $note_index => $note) {
        echo $note_index.",".$note.",";
    }
    echo "<br>".PHP_EOL;

    foreach (make_me_a_scale('C', $scale)  as $note_index => $note) {
        echo $note_index.",".$note.",";
    }
    echo "<br>".PHP_EOL;
    echo "</p>";
}

echo "<p dir=ltr>".PHP_EOL;
foreach (scale_available('?') as $index => $scale) {
    /*    echo $scale.",";
    foreach (define_scale($scale) as $note_index => $note) {
        echo $note_index.",".$note.",";
    }
    echo "<br>".PHP_EOL;
    */
    compare($scale);
}
echo "</p>";



?>
</body></html>

