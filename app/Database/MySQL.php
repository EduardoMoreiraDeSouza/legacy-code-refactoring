<?php

namespace App\Database;

class MySQL
{
    private static $instancia = null;

    public static function getInstancia() 
    {
        if (self::$instancia == null) {
            self::$instancia = new \PDO('mysql:dbname=dc_financeiro;host=mysql','root','root',array(
                \PDO::ATTR_ERRMODE, 
                \PDO::ERRMODE_EXCEPTION,
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
        }

        return self::$instancia;
    }
}