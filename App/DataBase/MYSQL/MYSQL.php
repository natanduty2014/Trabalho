<?php

namespace App\DataBase\MYSQL;

use PDO;

class MYSQL
{

    private static $host;
    private static $usuario;
    private static $senha;
    private static $db;
    private static $porta;    
    private static function config($host, $usuario, $senha, $db, $porta){
        static::$db = $db;
        static::$host = $host;
        static::$usuario = $usuario;
        static::$senha = $senha;
        static::$porta = $porta;
        try {
            $conn = new PDO("mysql:dbname=".static::$db.";host=".static::$host.";port=".static::$porta, static::$usuario,static:: $senha);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }

    }
    public static function conn($host, $db, $usuario, $senha, $porta)
    {
        static::$db = $db;
        static::$usuario = $usuario;
        static::$senha = $senha;
        static::$porta = $porta;
        static::$host = $host;
       $conn = self::config(static::$host, static::$usuario, static::$senha, static::$db, static::$porta);
       return $conn;
    }

    public static function query($conn, $tabela)
    {
        
        try {
            $pdo = $conn;
            $stmt = $pdo->prepare("SELECT * FROM $tabela WHERE texto = :texto");
            $stmt->bindValue(':texto', 'jnjnn', PDO::PARAM_STR);
           
            if ($stmt->execute()) {
                if($stmt->rowCount() > 0){
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        echo "<br>";
                        echo $rs->texto; // O resultado neste caso gera um objeto por linha
                     }
                }else{
                        return "Nem um dados foram encontrados.";
                }
            } else {
                return "Erro: Não foi possível recuperar os dados do banco de dados";
            }
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public static function insert($conn, $tabela)
    {
       try {
        $pdo = $conn;
        $stmt = $pdo->prepare("INSERT INTO $tabela (texto) VALUES (:texto)");
        $stmt->bindValue(':texto', 'jnjnn', PDO::PARAM_STR);
        $stmt->execute();
        return "Gravado no Banco de dados.";
       } catch (\Throwable $e) {
        echo $e->getMessage();
       }
    }

    public static function update($conn, $tabela)
    {
        try {
            $pdo = $conn;
            $stmt = $pdo->prepare("UPDATE tb_usuarios SET $tabela = :login, userSenha = :senha WHERE idusuario = :id"); 
            $login = "alinoca";
            $senha = "45678";
            $id = 3; //Referência de suporte ao WHERE
            $stmt->bindParam(":login", $login);
            $stmt->bindParam(":senha", $senha);
            $stmt->bindParam(":id", $id); 
            $stmt->execute();
            echo "Registro atualizado com sucesso!";
        } catch (\Throwable $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function delete($conn, $tabela)
    {
        try {
            $pdo = $conn;
            $stmt = $pdo->prepare("DELETE FROM $tabela WHERE id = :id");
            $stmt->bindValue(":id", 1, PDO::PARAM_INT);
            $stmt->execute();
            echo "Registro excluído com sucesso!";
        } catch (\Throwable $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
