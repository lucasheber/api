<?php

namespace Source\Core;

use PDO;

/**
 * FSPHP | Class Connect [ Singleton Pattern ]
 *
 * @author Lucas Heber <lucas.heber07@gmail.com>
 * @package Source\Core
 */
class Connect
{
    private const array OPTIONS = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        \PDO::ATTR_CASE => \PDO::CASE_NATURAL
    ];

    private static PDO $instance;

    public static function getInstance(): \PDO
    {
        if (empty(self::$instance)) {
            try {
                // creating a connection with postgres
                self::$instance = new \PDO(
                    sprintf(
                        "pgsql:host=%s;port=%s;dbname=%s",
                        getenv('DB_HOST'),
                        getenv('DB_PORT'),
                        getenv('DB_NAME')
                    ),
                    getenv('DB_USER'),
                    getenv('DB_PASS'),
                    self::OPTIONS
                );
            } catch (\PDOException $exception) {
                error_log($exception->getMessage());
                die("<h1>Erro ao conectar no banco de dados</h1>");
            }
        }

        return self::$instance;
    }


    private function __construct()
    {
    }

    private function __clone()
    {
    }
}
