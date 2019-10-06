<?php

include 'inc/init.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

$template = new Template();

switch ($action) {
    case 'new' :
        $employee = new Employee;

        if (!empty($_POST)) {
            $employee->firstname = $_POST['employee']['firstname'];
            $employee->lastname = $_POST['employee']['lastname'];
            $employee->birth = $_POST['employee']['birth'];
            $employee->employed = $_POST['employee']['employed'];
            $employee->phone = $_POST['employee']['phone'];
            $employee->postId = $_POST['employee']['postId'];
            $employee->departmentId = $_POST['employee']['departmentId'];


            if ($employee->checkout()) {
                $employee->save();
                header('Location: ./employees.php');
                exit;
            } else {
                $template->errors = $employee->errors;
            }
        }

        $template->name = 'employees/form';
        $template->posts = Post::getList([], [], 0, 0);
        $template->departments = Department::getList([], [], 0, 0);
        $template->employee = $employee;
        break;
    case 'edit' :
        if (empty($_GET['id'])) {
            header('Location: ./employees.php');
            exit;
        }

        $employee = new Employee($_GET['id']);

        if (!$employee->id) {
            header('Location: /employees.php');
            exit;
        }

        if (!empty($_POST)) {
            $employee->firstname = $_POST['employee']['firstname'];
            $employee->lastname = $_POST['employee']['lastname'];
            $employee->birth = $_POST['employee']['birth'];
            $employee->employed = $_POST['employee']['employed'];
            $employee->phone = $_POST['employee']['phone'];
            $employee->postId = $_POST['employee']['postId'];
            $employee->departmentId = $_POST['employee']['departmentId'];

            if ($employee->checkout()) {
                $employee->save();
                header('Location: ./employees.php');
                exit;
            } else {
                $template->errors = $employee->errors;
            }
        }

        $template->name = 'employees/form';
        $template->posts = Post::getList([], [], 0, 0);
        $template->departments = Department::getList([], [], 0, 0);
        $template->employee = $employee;
        break;
    case 'delete' :
        if (empty($_GET['id'])) {
            header('Location: ./employees.php');
            exit;
        }

        Employee::deleteStatic($_GET['id']);
        header('Location: ./employees.php');
        exit;
        break;
    default :
        $template->name = 'employees/list';

        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $employees_count = Employee::getCount(isset($_GET['filter']) ? $_GET['filter'] : []);
        $pages_count = ceil($employees_count / 5);

        $template->employees = Employee::getList(isset($_GET['filter']) ? $_GET['filter'] : [], [], 5 * ($current_page - 1) );
        $template->posts = Post::getList([], [], 0, 0);
        $template->departments = Department::getList([], [], 0, 0);
        
        if (isset($_GET['filter'])) {
            $template->filter = $_GET['filter'];

            $filterGetParams = [];
            foreach($_GET['filter'] as $field => $dir) {
                $filterGetParams = "filter[{$field}]={$dir}";
            }
            $template->filterGetParams = implode('&', $filterGetParams);
        } else { 
            $template->filter = [];
            $template->filterGetParams = '';
        }
        
        $directions = [
            'id' => 'asc',
            'firstname' => 'asc',
            'lastname' => 'asc',
            'phone' => 'asc',
            'birth' => 'asc',
            'employed' => 'asc',
            'department' => 'asc',
            'post' => 'asc'
        ];
        
        if ($_GET['order']) {
            foreach ($_GET['order'] as $field => $dir) {
                if ($dir == 'asc') {
                    $directions[$field] = 'desc';
                } else if ($dir == 'desc') {
                    $directions[$field] = '';
                } else {
                    $directions[$field] = 'asc';
                }
            }
        }
        $template->directions = $directions;
        
        $orderGetParams = [];
        if ($_GET['order']) {
            foreach ($_GET['order'] as $field => $dir) {
                $orderGetParams[] = "order[{$field}]={$dir}";
            }

            $template->orderGetParams = $orderGetParams;
            $template->formOrderParams = $_GET['order'];
        } else {
            $template->orderGetParams = '';
            $template->formOrderParams = [];
        }

        $template->pages_count = $pages_count;
        break;

}

echo $template->render();