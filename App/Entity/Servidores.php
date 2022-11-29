<?php

namespace App\Entity;

use App\DataBase\MYSQL\MYSQL as DB;
use App\Functions\Upload as Upload;
class Servidores extends DB{
   
    //ação para retornar a permição
    public static function Level(){
       // self::query();
    }
    //ação por logar o usuario
    public static function Login(){
       // self::query();
    }
    //ação por cadastro do servidores
    public static function Cadastro(){
       // self::insert();
    }
}