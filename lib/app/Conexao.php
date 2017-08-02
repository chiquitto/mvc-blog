<?php

//namespace App;

//use PDO;

class Conexao
{
    /**
     * @var PDO
     */
    private static $instance;

    /**
     * @return PDO
     */
    public static function getConexao()
    {
        if (static::$instance === null) {

            $dsn = "mysql:dbname=" . BD_NOME . ";host=" . BD_HOST;

            try {
                static::$instance = new PDO($dsn, BD_USUARIO, BD_SENHA);
                static::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                static::$instance->query('SET NAMES UTF8'); // UTF-8 Mysql
            } catch (PDOException $e) {
                echo "Conexão falhou. Erro: " . $e->getMessage();
                exit;
            }
        }

        return static::$instance;
    }
}