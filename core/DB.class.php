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

    public static function query($sql, $params = [])
    {
        $stmt = self::getInstance()->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}