<?php

function debug($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function readConfig() {
	$filepath = __DIR__."/configuracoes/config.json";
	$configuracaoJson = file_get_contents($filepath);

    $configuracoes = array();
    if($configuracaoJson) {
        $configuracoes = json_decode($configuracaoJson, true);
    }
    return $configuracoes;
}

function moneyToNumber($money) {
    $number = str_replace('.', '', $money);
    $number = str_replace(',', '.', $number);
    return $number;
}

function numberToMoney($number) {
    return number_format($number, 2, ",", ".");
}

function percentToNumber($percent) {
    $number = str_replace(',', '.', $percent);
    return $number;
}

function numberToPercent($number) {
    return number_format($number, 2, ',', '');
}

// Function to get the user IP address
function getUserIP() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = '000';

    $ipaddress = str_replace('.', '', $ipaddress);
    $ipaddress = str_replace(':', '', $ipaddress);
    return $ipaddress;
}

function getIdUsuario() {
    $ip = getUserIP();
    $id = $ip.$_SERVER['REQUEST_TIME'];
    return $id;
}

?>