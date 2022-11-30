<?php

require "vendor/autoload.php";



use App\Entity\Servidores;
use App\Functions\Crypt;
use Firebase\JWT\JWT;

$code = Crypt::lbsodiumEncryp('teste do phpa');
//echo $code. '\n';

$string = $code;
$string = explode(".", $string);
//echo $string[2];
echo Crypt::libsodiumVery($string[0], $string[2]);

$conn = Servidores::conn('localhost', 'phpteste', 'root', '', '3306');
 //echo Servidores::insert($conn, 'teste');
http_response_code(200);
exit;