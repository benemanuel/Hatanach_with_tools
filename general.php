<?php
function number_check($int){#true if number
// First check if it's a numeric value as either a string or number
    if(is_numeric($int) === TRUE){

        // It's a number, but it has to be an integer
        if((int)$int == $int){

            return TRUE;

        // It's a number, but not an integer, so we fail
        }else{

            return FALSE;
        }

    // Not a number
    }else{

        return FALSE;
    }
}

function url_origin( $s, $use_forwarded_host = false ){#url parsed
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = isset ( $s['SERVER_PROTOCOL']) ? strtolower( $s['SERVER_PROTOCOL'] ) : '';
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'] ?? 0;
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function full_url( $s, $use_forwarded_host = false ){#url source

    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}

function clean_url(){#url without query
    return  (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]".strtok($_SERVER["REQUEST_URI"],'?');
}

function addme($cookie_name,$cookie_value,$life=1){ // 1 day
    setcookie($cookie_name,$cookie_value,(time() + ($life * 86400)) , "/", "geulah.org.il");
}

function checkme($cookie_name){
  if(!isset($_COOKIE[$cookie_name])) {
    if ($debug_flag)
       {
         echo "<p debug='checkme called:";
         echo "Cookie named '" . $cookie_name . "' is not set!";
         echo "'></p>";
       }
    return false;
  } else {
    if ($debug_flag)
       {
         echo "<p debug='checkme called:";
         echo "Cookie '" . $cookie_name . "' is set!<br>";
         echo "Value is: " . $_COOKIE[$cookie_name];
         echo "'></p>";
       }
    return $_COOKIE[$cookie_name];
  }
}

function dump_variables($_get_defined_vars=[]){
 global $_c;
    function ev($_variable){
        global $_c;
        foreach($GLOBALS as $_key => $_value){
            if($_variable===$_value){
                if  (!((substr($_key, 0, 1) == "_") || ($_key == "GLOBALS") || ($_key == "argc") || ($_key == "argv"))) {
                    if  (!((substr($_key, 0, 6) == "hebnum"))) {
                        array_push($_c,array($_key,json_encode($_value,JSON_UNESCAPED_UNICODE)));
                    }
                }
            }
        }
    }
        
        /*print_r(array_keys(get_defined_vars()));
        cat a|awk -F'\> ' '{print $2}'|awk -F# '{print "$c.= PHP_EOL.\""$1"= \"; $c.= ($"$1")? \"true [\".$"$1".\"] \". strlen($"$1") :\"false\"; "}' >> a.php
        
        api.php | awk -F\$ '{print $2}'|sort|awk -F '[^[:alnum:]]' '{print  $1}'|uniq|awk -F# '{print "$c.= PHP_EOL.\"$"$1"= \"; $c.= ($"$1")? \"true [\".$"$1".\"] \". strlen($"$1") :\"false\"; "}' >> api.php
        */
    $_c=array();
    foreach ($_get_defined_vars as $_p => $_part) {ev($_part);}
    sort($_c);
    $_old_key=""; $_old_value=""; $_x=array();
    foreach($_c as $_key => $_value)
    {
        if (!(($_old_key == $_value[0]) && ($_old_value == $_value[1])))
            array_push($_x,array($_value[0],$_value[1]));
        $_old_key = $_value[0]; $_old_value = $_value[1];
    }
    
    return json_encode($_x,JSON_UNESCAPED_UNICODE);
    //echo "<p debug='after set cookies flags called:".json_encode($_x,JSON_UNESCAPED_UNICODE)."'></p>";
}

