<?php
function push_buttons($key=0){//$hebbook,$shortbook,$ch,$vr,$key){#
    global $debug_flag;
    if ($debug_flag){ echo PHP_EOL."<p debug=push_buttons'". $key."'></p>";}
    if ($key>=10){
        include_once __DIR__ . "/next_previous.php";
        include_once __DIR__ . "/convertor.php";
        include_once __DIR__ . "/booklookup.php";
        list($shortbook, $ch, $vr) = explode(".", convertor($key,"",true));
        $hebbook = show_book(shorteng_bookcode($shortbook),2);
        
        if (!defined('sefer')) define('sefer'," ספר:");
        if (!defined('perek')) define('perek'," פרק:");
        if (!defined('quote')) define('quote','"');
        
        $cURL="https://hatanach.geulah.org.il/verse/?cit=";
        $kURL="https://hatanach.geulah.org.il/verse/?key=";
        $PreviousChapter = previous_chapter($key);
        $PreviousVerse = previous_verse($key);
        $FullChapter = $shortbook . $ch . '&highlight='. $vr;
        $FullChapterName = sefer . $hebbook  . " " . perek . $ch ;
        $NextVerse = next_verse($key);
        $NextChapter = next_chapter($key);
        ?>
        <ul>
        <li class="tooltip expand"  data-title="Previous Chapter">
        <a href=<?php echo quote. $kURL. $PreviousVerse. quote ?> target="_blank" class="previous verse">&#9654;</a></li>
        <li class="tooltip expand"  data-title="Previous Verse">
        <a href=<?php echo quote. $kURL. $PreviousChapter . quote ?> target="_blank" class="previous chapter">&#9654;פרק הקודם</a></il>
        <li class="tooltip expand"  data-title="Full Chapter">
        <a href=<?php echo quote. $cURL. $FullChapter.quote ?> target="_blank" class="full chapter"><?php echo $FullChapterName ?></a></li>
        <li class="tooltip expand"  data-title="Next Verse">
        <a href=<?php echo quote. $kURL. $NextVerse. quote ?> target="_blank" class="next verse">&#9664;</a></li>
        <li class="tooltip expand"  data-title="Next Chapter">
        <a href=<?php echo quote. $kURL. $NextChapter. quote ?> target="_blank" class="next chapter">פרק הבא&#9664;</a></li>
        </ul>
<?php
    }
}
