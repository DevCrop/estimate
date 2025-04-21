<?php

class DB
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        require CONFIG_PATH . '/db.php';

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            echo "❌ DB 연결 실패: " . $e->getMessage();
            exit;
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function beginTransaction() {
        $this->pdo->beginTransaction();
    }

    public function commit() {
        $this->pdo->commit();
    }

    public function rollBack() {
        $this->pdo->rollBack();
    }

    public function insert($table, $data) {
        $keys = array_keys($data);
        $columns = implode(',', $keys);
        $placeholders = implode(',', array_map(fn($key) => ":$key", $keys));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }

    public function update($table, $data, $where) {
        $set = implode(',', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $conditions = implode(' AND ', array_map(fn($key) => "$key = :where_$key", array_keys($where)));
        $sql = "UPDATE $table SET $set WHERE $conditions";

        $params = array_merge(
            $data,
            array_combine(array_map(fn($k) => "where_$k", array_keys($where)), array_values($where))
        );

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public static function query($sql, $params = []) {
        $stmt = self::getInstance()->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}