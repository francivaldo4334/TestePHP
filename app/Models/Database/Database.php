<?php

namespace App\Models\Database;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $pdo = null;
    public function __construct()
    {
        $configPath = __DIR__ . '/../../config/database.php';        
        $c = require $configPath;
        $dsn = "{$c['driver']}:host={$c['host']};dbname={$c['database']};charset={$c['charset']}";
        
        $this->pdo = new PDO($dsn, $c['username'], $c['password'], $c['options']);
    }
    public static function getConnection()
    {
    	if (!self::$instance) {
            try {
                self::$instance = new Database();
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
    public function select($sql): array
    {
    	return [];
    }
    public function insert($sql, $model): mixed
    {
    	return [];
        }
    public function delete($sql)
    {
    	
    }
}
