<?php
// based on source:https://github.com/erelsgl/tnk/blob/master/script/hebrew.php

/**
 * @file hebrew.php handle Hebrew-specific actions like "gimatriya" - קידוד חלונות
 * 
 */

### Hebrew letters ###
if (!defined('otiot_txiliot')) define('otiot_txiliot',"אבגדהוזחטיכלמנסעפצקרשת");
if (!defined('otiot_ivriot')) define('otiot_ivriot',"אבגדהוזחטיךכלםמןנסעףפץצקרשת");
if (!defined('letters1')) define('letters1',array('א','ב','ג','ד','ה','ו','ז','ח','ט','י'));
if (!defined('letters10')) define('letters10',array(
		array('י','כ','ל','מ','נ','ס','ע','פ','צ','ק'),
		array('י','ך','ל','ם','ן','ס','ע','ף','ץ','ק')));
if (!defined('letters100')) define('letters100',array('ק','ר','ש','ת'));
if (!defined('hebrew2number')) define('hebrew2number',array(
		'א' => 1,
		'ב' => 2,
		'ג' => 3,
		'ד' => 4,
		'ה' => 5,
		'ו' => 6,
		'ז' => 7,
		'ח' => 8,
		'ט' => 9,
		'י' => 10,
		'ך' => 20,
		'כ' => 20,
		'ל' => 30,
		'ם' => 40,
		'מ' => 40,
		'ן' => 50,
		'נ' => 50,
		'ס' => 60,
		'ע' => 70,
		'ף' => 80,
		'פ' => 80,
		'ץ' => 90,
		'צ' => 90,
		'ק' => 100,
		'ר' => 200,
		'ש' => 300,
		'ת' => 400
));


### regular expressions for Hebrew numbers ###
if (!defined('hebchar1')) define('hebchar1',"[א-ט]");
if (!defined('hebchar10')) define('hebchar10',"[י-צ]");
if (!defined('hebchar100')) define('hebchar100',"[ק-ת]");
if (!defined('hebchar')) define('hebchar',"[א-ת]");

$hebnum1 = hebchar1;
$hebnum2 = "(?:טו|טז|hebchar10|hebchar10$hebnum1)";
$hebnum12 = "(?:טו|טז|hebchar10|(?:hebchar10$hebnum1)|$hebnum1)";
$hebnum3 = "hebchar100$hebnum12?";
$hebnum = "(?:$hebnum12|$hebnum3)";

if (!defined('values')) define('values',array (1,2,3,4,5,6,7,8,9,10,20,20,30,40,40,50,50,60,70,80,80,90,90,100,200,300,400));


function number2hebrew($num, $sofiot=false) {
	$heb = "";
	while ($num > 400) {
		$heb .= "ת";
		$num -= 400;
	}
	if ($num >= 100) {
		$heb .= letters100[ floor($num / 100) - 1 ];
		$num %= 100;
	}
	if ($num >= 10) {
		if ($num == 15) {
			$heb .= "טו";
			$num = 0;
		} elseif ($num == 16) {
			$heb .= "טז";
			$num = 0;
		} else {
			$heb .= letters10[$sofiot][ floor($num / 10) - 1 ];
			$num %= 10;
		}
	}
	if ($num >= 1) {
		$heb .= letters1[ $num - 1 ];
	}
	
	return $heb;
}

