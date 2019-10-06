<?php

abstract class Table {
    protected static $table = '';
    protected static $fields = [];

    protected $_id;
    protected $_values = [];
    protected $_errors = [];

    public function __get($name) {
        if ($name == 'id') {
            return $this->_id;
        }

        if ($name == 'errors') {
            return $this->_errors;
        }

        if (in_array($name, static::$fields)) {
            return $this->_values[$name];
        }

        return null;
    }

    public function __set($name, $value) {
        if (in_array($name, static::$fields)) {
            $this->_values[$name] = $value;
        }
    }

    public function __isset($name) {
        return !empty($this->_values[$name]);
    }

    public function __construct($id = null) {
        foreach (static::$fields as $field) {
            $this->_values[$field] = null;
        }

        if ($id) {
            $row = Database::getInstance()->select_row("
                SELECT *
                FROM `" . static::$table . "`
                WHERE `id` = $id
            ");

            if ($row) {
                $this->_id = $id;

                foreach (static::$fields as $field) {
                    $this->_values[$field] = $row[$field];
                }
            }
        }
    }

    protected function update() {
        $sql = "UPDATE `" . static::$table . "`  SET ";

        foreach ($this->_values as $field => $value) {
            $sql .= "`$field` = '$value', ";
        }

        $sql = rtrim($sql, ', ');

        $sql .= " WHERE `id` = {$this->_id}";

        if (!Database::getInstance()->query($sql)) {
            throw new Exception("Не могу обновить объект класса " . get_called_class());
        }
    }

    protected function insert() {
        $sql = "INSERT INTO `" . static::$table . "`";
        $sql .= " (`" . implode('`, `', static::$fields) . "`) ";
        $sql .= "VALUES ('" . implode("', '", $this->_values) . "')";

        if (!Database::getInstance()->query($sql)) {
            throw new Exception("Не могу добавить объект класса " . get_called_class());
        }

        $this->_id = Database::getInstance()->insert_id();
    }

    public function save() {
        if ($this->_id) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    protected static function filter($filter) {
        return '1';
    }

    public static function getList($filter = [], $order = [], $offset = 0, $limit = 5) {
        $sql = "SELECT * FROM `" . static::$table . "`";

        if ($filter) {
            $sql .= static::filter($filter);
        }

        if (!empty($order)) {
            $sql .= " ORDER BY ";
            foreach ($order as $field => $dir) {
                $sql .= "`$field` $dir, ";
            }

            $sql = rtrim($sql, ', ');
        }

        if ($limit) {
            $sql .= " LIMIT $offset, $limit";
        }

        $rows = Database::getInstance()->select_rows($sql);

        $objects = [];
        foreach ($rows as $row) {
            $object = new static;
            $object->_id = $row['id'];

            foreach (static::$fields as $field) {
                $object->_values[$field] = $row[$field];
            }

            $objects[$row['id']] = $object;
        }

        return $objects;
    }

    public static function getCount($filter) {
        $sql = "SELECT count(*) FROM `" . static::$table . "`";

        if ($filter) {
            $sql .= static::filter($filter);
        }

        return Database::getInstance()->select_value($sql);
    }

    public function delete() {
        $sql = "DELETE FROM `" . static::$table . "` WHERE `id` = {$this->id}";

        if (!Database::getInstance()->query($sql)) {
            throw new Exception("Не могу удалить объект класса " . get_called_class());
        }
    }

    public static function deleteStatic($id) {
        $sql = "DELETE FROM `" . static::$table . "` WHERE `id` = {$id}";

        if (!Database::getInstance()->query($sql)) {
            throw new Exception("Не могу удалить строку из таблицы " . static::$table);
        }
    }

    public function checkout() {
        return true;
    }
}