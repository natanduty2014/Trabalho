<?php

namespace App\Functions;

//class de criptografia
class Crypt
{

    //usando a libsodium para criptografia   
    protected static function lbsodiumencrypPrivrate($data)
    {
        $msg = $data;

        // Generating an encryption key and a nonce
        $key   = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES); // 256 bit
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES); // 24 bytes
        // Encrypt
        $ciphertext = sodium_crypto_secretbox($msg, $nonce, $key);
        return base64_encode($ciphertext).".".base64_encode($nonce).".".base64_encode($key);
    }

    public static function lbsodiumEncryp($data)
    {
        return self::lbsodiumencrypPrivrate($data);
    }

    //usando a libsodium para descriptografia
    protected static function lbsodiumdecrypPrivate($data, $nonceD, $keyD)
    {
        $msg = "teste do php";
        $ciphertext = base64_decode($data);
        $nonce = base64_decode($nonceD);
        $key = base64_decode($keyD);
        // Decrypt
        $plaintext = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
        if ($plaintext !== false) {
            return $plaintext . PHP_EOL;
        }else{
            return "erro ao abrir/descriptografar.";
        }
    }

    public static function lbsodiumDecryp($data, $nonceD, $keyD)
    {
        return self::lbsodiumdecrypPrivate($data, $nonceD, $keyD);
    }

    //verificar a integridade da criptografia em libsodium
    protected static function libsodiumveryPrivate($data, $keyD)
    {
        $msg = base64_decode($data);
        $key = base64_decode($keyD); // 256 bit

        // Generate the Message Authentication Code
        $mac = sodium_crypto_auth($msg, $key);

        // Altering $mac or $msg, verification will fail
        return sodium_crypto_auth_verify($mac, $msg, $key) ? 'Criptografia valida!' : 'Não é valido';
    }

    public static function libsodiumVery($data, $keyD)
    {
        return self::libsodiumveryPrivate($data, $keyD);
    }
}
