<?php
function single_verse($osis){
    return ((strpos($osis, "EEE") + strpos($osis, "-") + strpos($osis, ",")) == 0);
}
