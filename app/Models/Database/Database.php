<?php

namespace App\Models\Database;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $pdo = null;
    public function __construct()
    {
        $c = require_once __DIR__ . '/../../../config/database.php';
        $dsn = "{$c['driver']}:host={$c['host']};dbname={$c['database']};charset={$c['charset']}";
        $this->pdo = new PDO($dsn, $c['username'], $c['password'], $c['options']);

        $createTablesSchema = $this->getScritpSql('schema');
        $this->pdo->exec($createTablesSchema);
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
    public function select($sql, $params = [], $entityClass = null): array
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $entityClass);
    }
    public function insert($sql, $model): mixed
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($model);
    }
    public function delete($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
    public function getScritpSql($path){        
       $file = __DIR__.'/../../../scripts/sql/'.$path.'.sql'; 
       return file_exists($file) ? file_get_contents($file): '';
    }
}
