<?php

namespace App\Database;

class MySQL
{
    private static $instancia;

    public static function getInstancia()
    {
        if (null === self::$instancia) {
            self::$instancia = new \PDO(
                'mysql:dbname=dc_financeiro;host=localhost;charset=utf8',
                'root',
                '',
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                ]
            );
        }

        return self::$instancia;
    }
}
