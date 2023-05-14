<?php
function show_translit($verse,$raw = 1 ,$title_string = '<p dir="ltr" lang="en">The Transliteration is:</p>'){#transliteration verse
    //gets  verse, returns transverse
    if (!defined('html')) define('html',1);
    if (!defined('text_only')) define('text_only',0);
    $transverse = "";
    
    $returned_answer[0] = -1;
    $returned_answer_index = 1;
    
    $command_line = 'cd  /var/www/hatanach/verse/script/ && node hebapp.js -t ' . " '" . $verse . "'  2>&1";
    
    $transverse = exec($command_line, $out, $err);
    

    if ($raw == text_only)
    {
        $returned_answer[1] =   $transverse . PHP_EOL;
        $returned_answer[0] = 1;
    } else {
        $returned_answer[1] = $title_string;
        $returned_answer[2] = '<p dir="ltr" lang="en" class="transliteration-text-area">' . $transverse . PHP_EOL . '</p>';
        $returned_answer[0] = 2;
    }
    return  $returned_answer;
}

