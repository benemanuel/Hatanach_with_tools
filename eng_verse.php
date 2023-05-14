<?php
//convert hebrew key verse to transilation versifications cit
//get key give cit

function eng_verse($key){#eng_citation
    global $debug_flag;
    include_once __DIR__ . "/db_call.php";

    /*
+-------+-------------+
| Field | Type        |
+-------+-------------+
| id    | int(11)     |
| heb   | varchar(16) |
| eng   | varchar(16) |
+-------+-------------+
*/
    if ($debug_flag) {echo "<p debug='fun eng_verse:". $key ."'></p>";}
    $result = db_call('engcit','select * from engcit WHERE id = ' . $key. ' LIMIT 1');
    if (count($result)>0) return $result[0]['eng'];
    else  return "Same";
}
