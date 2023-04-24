<?php

function mySha256($str) {
    $str = hash('sha256', $str);
return $str;
}

?>