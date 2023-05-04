<?php
namespace lib;

use PDO;
use PDOException;

final class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        if (!file_exists('config/db.php'))
        {
            die('Конфигурационный файл db.php отсутствует!');
        }
        $config = require 'config/db.php';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $dbname = $config['dbname'] ?? '';
        $host = $config['host'] ?? '';
        $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
        try
        {
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            die('Невозможно подключиться к БД. Ошибка: ' . $e->getMessage());
        }
    }

    private function __clone(){}

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Return: false | PDOStatement
    public function safeQuery($sql, $params = [])
    {
        if (!is_array($params)) return false;
        if (empty($params))
        {
            return $this->pdo->query($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        if ($stmt === false) return false;
        foreach ($params as $key => $value)
        {
            $stmt->bindValue(':'.$key, $value);
        }
        $success = $stmt->execute();
        if ($success) return $stmt;
        return false;
    }

    public function insert($table, $params) :bool
    {
        if (!is_array($params)) return false;
        if (empty($params)) return false;
        $columns = '';
        $values = '';
        foreach ($params as $key => $value) {
            $columns .= "`{$key}`,";
            $values .= ":{$key},";
        }
        $columns = rtrim($columns, ',');
        $values = rtrim($values, ',');
        $sql = sprintf('INSERT INTO `%s`(%s) VALUES (%s)', $table, $columns, $values);
        $result = $this->safeQuery($sql, $params);
        if ($result !== false) return true;
        return false;
    }

    public function getRows($table)
    {
        $sql = "SELECT * FROM {$table}";
        $stmt = $this->safeQuery($sql);
        if ($stmt !== false)
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        return false;
    }

    public function getRowById($table, $id)
    {
        $sql = "SELECT * FROM {$table} WHERE `id` = :id";
        $stmt = $this->safeQuery($sql, ['id' => $id]);
        if ($stmt !== false)
            return $stmt->fetch(PDO::FETCH_ASSOC);
        return false;
    }

    public function deleteRowById($table, $id) :bool
    {
        $sql = "DELETE FROM {$table} WHERE `id` = :id";
        $stmt = $this->safeQuery($sql, ['id' => $id]);
        if ($stmt !== false) return true;
        return false;
    }

    public function updateRowById($table, $id, $params) :bool
    {
        if (!is_array($params)) return false;
        if (empty($params)) return false;
        $assignmentList = '';
        foreach ($params as $key => $value) {
            $assignmentList .= "`{$key}` = :{$key},";
        }
        $assignmentList = rtrim($assignmentList, ',');
        $sql = sprintf('UPDATE `%s` SET %s WHERE `id` = :id', $table, $assignmentList);
        $params['id'] = $id;
        $result = $this->safeQuery($sql, $params);
        if ($result !== false) return true;
        return false;
    }

    public function truncateTable($table) :bool
    {
        $sql = "TRUNCATE TABLE {$table}";
        $stmt = $this->safeQuery($sql);
        if ($stmt !== false) return true;
        return false;
    }
}