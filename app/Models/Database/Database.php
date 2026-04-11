<?php

namespace App\Models\Database;

use Exception;
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
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch(\PDOException $e) {
            if ($e->getCode() == '23000') {
                throw new Exception("Não é possível excluir este item pois existem referencias utilizando ele.", 409);
            }
            throw $e;
        }
    }
    public function getScritpSql($path){        
       $file = __DIR__.'/../../../scripts/sql/'.$path.'.sql'; 
       return file_exists($file) ? file_get_contents($file): '';
    }
}
