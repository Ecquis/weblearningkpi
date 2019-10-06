<?php

class Department extends Table {
    protected static $table = 'departments';
    protected static $fields = ['name', 'city', 'address', 'phone'];

    protected static function filter($filter) {
        $sql = [];

        if (!empty($filter['id'])) {
            $sql[] = "`id` = {$filter['id']}";
        }

        if (!empty($filter['name'])) {
            $sql[] = "`name` like '%{$filter['name']}%'";
        }

        if (!empty($filter['city'])) {
            $sql[] = "`city` like '%{$filter['city']}%'";
        }

        if (!empty($filter['address'])) {
            $sql[] = "`address` like '%{$filter['address']}%'";
        }

        if (!empty($filter['phone'])) {
            $sql[] = "`phone` like '%{$filter['phone']}%'";
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
            $this->_errors['id'] = 'Department id must be integer';
        }

        if (empty($this->name)) {
            $this->_errors['name'] = 'Department name must be set';
        }

        if (empty($this->city)) {
            $this->_errors['city'] = 'Department city must be set';
        }

        if (empty($this->address)) {
            $this->_errors['address'] = 'Department address must be set';
        }

        if (empty($this->phone)) {
            $this->_errors['phone'] = 'Department phone must be set';
        }


        return empty($this->_errors);
    }
}