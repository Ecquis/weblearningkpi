<?php

class Database {
    private static $_instance;

    private $_connection;

    private function __construct() {
        $this->_connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$this->_connection) {
            throw new Exception("Не установлено соединение с базой данных");
        }
    }

    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    public function query($sql) {
        $result = mysqli_query($this->_connection, $sql);

        if (!$result) {
            throw new Exception("Ошибка выполнения запроса: " . mysqli_error($this->_connection));
        }

        return $result;
    }

    public function select_rows($sql) {
        $result = $this->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function select_row($sql) {
        $result = $this->query($sql);

        return mysqli_fetch_assoc($result);
    }

    public function select_value($sql) {
        $result = $this->select_row($sql);

        if ($result) {
            return current($result);
        }

        return null;
    }

    public function insert_id() {
        return mysqli_insert_id($this->_connection);
    }
}

