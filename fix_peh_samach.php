<?php
function fix_peh_samach($data,$mesora=true){#verse without 'ײ' 'ױ'
    global $debug_flag;
    //    if ($debug_flag) {echo "<p debug='fun fix_p_s'></p>";}
       //  sed -i 's/ױ/ס֭/g' l.txt
        //  sed -i 's/ײ/פ/g' l.txt
        $pattern = 'ײ';    $replace = 'פ';
        $t1 = preg_replace("/".$pattern."/", $replace, $data);
        $pattern = 'ױ';     $replace = 'ס';
        $t2 =preg_replace("/".$pattern."/", $replace, $t1);
        $pattern = 'װ';     $replace = " ";
        $t3 =preg_replace("/".$pattern."/", $replace, $t2);
        $pattern = '֯';    $replace = '';
        if ($mesora) return $t3; else return preg_replace("/".$pattern."/", $replace, $t3);  
}
