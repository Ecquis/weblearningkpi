<?php

class Post extends Table {
    protected static $table = 'posts';
    protected static $fields = ['name'];

    protected static function filter($filter) {
        $sql = [];

        if (!empty($filter['id'])) {
            $sql[] = "`id` = {$filter['id']}";
        }

        if (!empty($filter['name'])) {
            $sql[] = "`name` like '%{$filter['name']}%'";
        }

        $sql = implode(' AND ', $sql);

        if ($sql) {
            return " WHERE $sql";
        }

        return null;
    }

    public function checkout() {
        $this->_errors = [];

        if (!empty($this->id) && !is_numeric($this->id)) {
            $this->_errors['id'] = 'Post id must be integer';
        }

        if (empty($this->name)) {
            $this->_errors['name'] = 'Post name must be set';
        }

        return empty($this->_errors);
    }
}