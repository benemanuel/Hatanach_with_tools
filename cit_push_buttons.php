<?php
function cit_push_buttons($cit=""){//$hebbook,$shortbook,$ch,$vr){#
    global $debug_flag;
    if ($debug_flag){  echo PHP_EOL."<p debug='cit_push_buttons ". $cit."'></p>";}
    if (strlen($cit)>1) {
        include_once __DIR__ . "/single_verse.php";
        include_once __DIR__ . "/cit_next_previous.php";
        include_once __DIR__ . "/convertor.php";
        include_once __DIR__ . "/booklookup.php";
        
        if (single_verse($cit))
        {
            list($shortbook, $ch, $vr) = explode(".", convertor(convertor(0,$cit),"",true));
            $hebbook = show_book(shorteng_bookcode($shortbook),2);
            
            if (!defined('sefer')) define('sefer'," ספר:");
            if (!defined('perek')) define('perek'," פרק:");
            if (!defined('quote')) define('quote','"');
            
            if (!defined('cURL')) define('cURL',"https://hatanach.geulah.org.il/verse/?cit=");
            $PreviousChapter = cit_previous_chapter($cit);
            $PreviousVerse = cit_previous_verse($cit);
            $FullChapter = $shortbook . $ch . '&highlight='. $vr;
            $FullChapterName = sefer . $hebbook  . " " . perek . $ch ;
            $NextVerse = cit_next_verse($cit);
            $NextChapter = cit_next_chapter($cit);
            ?>
            <ul>
            <li class="tooltip expand"  data-title="Previous Chapter">
            <a href=<?php echo quote. cURL. $PreviousChapter . quote ?> target="_blank" class="previous chapter">&#9654;פרק הקודם</a></il>
            <li class="tooltip expand"  data-title="Previous Verse">
            <a href=<?php echo quote. cURL. $PreviousVerse. quote ?> target="_blank" class="previous verse">&#9654;</a></li>
            <li class="tooltip expand"  data-title="Full Chapter">
            <a href=<?php echo quote. cURL. $FullChapter.quote ?> target="_blank" class="full chapter"><?php echo $FullChapterName ?></a></li>
            <li class="tooltip expand"  data-title="Next Verse">
            <a href=<?php echo quote. cURL. $NextVerse. quote ?> target="_blank" class="next verse">&#9664;</a></li>
            <li class="tooltip expand"  data-title="Next Chapter">
            <a href=<?php echo quote. cURL. $NextChapter. quote ?> target="_blank" class="next chapter">פרק הבא&#9664;</a></li>
            </ul>
<?php
        } // not single
    }
}
