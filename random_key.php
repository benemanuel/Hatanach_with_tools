<?php
	// seed with microseconds
function make_seed(){#seed
		list($usec, $sec) = explode(' ', microtime());
		return (float) $sec + ((float) $usec * 100000);
}

function random_key(){#random
	srand(make_seed());
	$randval = rand();
	$random = ($randval%23212)+1;
return  $random*10;
}

function GoToNow ($url){
     $u2=$url. "&random_call=true&date=". $_SERVER['REQUEST_TIME'];
     echo '<script language="javascript">
            window.location.href = "'.$u2. '"
          </script>';
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $url . '">';
}
