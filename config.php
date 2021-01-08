<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: x-access-header, Authorization, Origin, X-Requested-With, Content-Type, Accept");

function e_url( $s ) {
    return rtrim(strtr(base64_encode($s), '+/', '-_'), '='); 
}
 
function d_url($s) {
    return base64_decode(str_pad(strtr($s, '-_', '+/'), strlen($s) % 4, '=', STR_PAD_RIGHT));
}

$api = "https://apigrabber.herokuapp.com/";
#$api = "http://127.0.0.1:5000/";
$GLOBALS['api'] = $api;
?>