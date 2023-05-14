<?PHP
function not_block_output($text,$cit=""){
    echo '<div class="hidden" style="display: none;">';print_r(array($text,$cit)); echo '</div>';
    if (substr_count($text, ')') > 0){
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

