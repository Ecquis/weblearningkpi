<?php
class Employee extends Table {
    protected static $table = 'employees';
    protected static $fields = ['firstname', 'lastname', 'birth', 'employed', 'phone', 'postId', 'departmentId'];

    private $_postName;
    private $_departmentName;

    public function __get($name) {
        if ($name == 'postName') {
            return $this->_postName;
        }

        if ($name == 'departmentName') {
            return $this->_departmentName;
        }

        return parent::__get($name);
    }

    protected static function filter($filter) {
        $sql = [];

        if (!empty($filter['id'])) {
            $sql[] = "`employees`.`id` = {$filter['id']}";
        }

        if (!empty($filter['firstname'])) {
            $sql[] = "`employees`.`firstname` like '%{$filter['firstname']}%'";
        }

        if (!empty($filter['lastname'])) {
            $sql[] = "`employees`.`lastname` like '%{$filter['lastname']}%'";
        }

        if (!empty($filter['birth'])) {
            $sql[] = "`employees`.`birth` like '%{$filter['birth']}%'";
        }

        if (!empty($filter['employed'])) {
            $sql[] = "`employees`.`employed` like '%{$filter['employed']}%'";
        }

        if (!empty($filter['phone'])) {
            $sql[] = "`employees`.`phone` like '%{$filter['phone']}%'";
        }

        if (!empty($filter['postId'])) {
            $sql[] = "`employees`.`postId` like '%{$filter['postId']}%'";
        }

        if (!empty($filter['departmentId'])) {
            $sql[] = "`employees`.`departmentId` like '%{$filter['departmentId']}%'";
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
            $this->_errors['id'] = 'Employee id must be integer';
        }

        if (empty($this->firstname)) {
            $this->_errors['firstname'] = 'Employee firstname must be set';
        }

        if (empty($this->lastname)) {
            $this->_errors['lastname'] = 'Employee lastname must be set';
        }

        if (empty($this->birth)) {
            $this->_errors['birth'] = 'Employee birth must be set';
        }

        if (empty($this->employed)) {
            $this->_errors['employed'] = 'Employee employed must be set';
        }

        if (empty($this->phone)) {
            $this->_errors['phone'] = 'Employee phone must be set';
        }

        if (empty($this->postId)) {
            $this->_errors['postId'] = 'Employee postId must be set';
        }

        if (empty($this->departmentId)) {
            $this->_errors['departmentId'] = 'Employee departmentId must be set';
        }

        return empty($this->_errors);
    }

    public static function getList($filter = [], $order = [], $offset = 0, $limit = 5) {
        $sql = "
            SELECT `employees`.*, `posts`.`name` as `postName`, `departments`.`name` as `departmentName` 
            FROM `employees` 
            LEFT JOIN `posts` ON `employees`.`postId` = `posts`.`id`
            LEFT JOIN `departments` ON `employees`.`departmentId` = `departments`.`id`
        ";

        if ($filter) {
            $sql .= self::filter($filter);
        }

        if (!empty($order)) {
            $sql .= " ORDER BY ";
            foreach ($order as $field => $dir) {
                switch ($field) {
                    case 'posts':
                        $sql .= "`posts`.`name` $dir";
                        break;
                    case 'departments':
                        $sql .= "CONCAT(`departments`.`name`, ' (', `departments`.`city`, ', ', `departments`.`address`, ')') $dir, ";
                        break;
                    default:
                        $sql .= "`employees`.`$field` $dir, ";
                        break;
                }
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

            $object->_postName = $row['postName'];
            $object->_departmentName = $row['departmentName'];

            $objects[$row['id']] = $object;
        }

        return $objects;
    }
}