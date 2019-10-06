<?php

include 'inc/init.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

$template = new Template();

switch ($action) {
    case 'new' :
        $department = new Department;

        if (!empty($_POST)) {
            $department->name = $_POST['department']['name'];
            $department->city = $_POST['department']['city'];
            $department->address = $_POST['department']['address'];
            $department->phone = $_POST['department']['phone'];

            if ($department->checkout()) {
                $department->save();
                header('Location: ./departments.php');
                exit;
            } else {
                $template->errors = $department->errors;
            }
        }

        $template->name = 'departments/form';
        $template->department = $department;
        break;
    case 'edit' :
        if (empty($_GET['id'])) {
            header('Location: ./departments.php');
            exit;
        }

        $department = new Department($_GET['id']);

        if (!$department->id) {
            header('Location: ./departments.php');
            exit;
        }

        if (!empty($_POST)) {
            $department->name = $_POST['department']['name'];
            $department->city = $_POST['department']['city'];
            $department->address = $_POST['department']['address'];
            $department->phone = $_POST['department']['phone'];

            if ($department->checkout()) {
                $department->save();
                header('Location: ./departments.php');
                exit;
            } else {
                $template->errors = $department->errors;
            }
        }

        $template->name = 'departments/form';
        $template->department = $department;
        break;
    case 'delete' :
        if (empty($_GET['id'])) {
            header('Location: ./departments.php');
            exit;
        }

        Department::deleteStatic($_GET['id']);
        header('Location: ./departments.php');
        exit;
        break;
    default :
        $template->name = 'departments/list';

        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $departments_count = Department::getCount(isset($_GET['filter']) ? $_GET['filter'] : []);
        $pages_count = ceil($departments_count / 5);

        $template->departments = Department::getList(isset($_GET['filter']) ? $_GET['filter'] : [], [], 5 * ($current_page - 1) );

        if (isset($_GET['filter'])) {
            $template->filter = $_GET['filter'];

            $filterGetParams = [];
            foreach ($_GET['filter'] as $field => $value) {
                $filterGetParams = "filter[{$field}]={$value}";
            }
            $template->filterGetParams = implode('&', $filterGetParams);
        } else {
            $template->filter = [];
            $template->filterGetParams = '';
        }

        $directions = [
          'id' => 'asc',
            'name' => 'asc',
            'city' => 'asc',
            'address' => 'asc',
            'phone' => 'asc'
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
            
            $template->orderGetParams = implode('&', $orderGetParams);
            $template->formOrderParams = $_GET['order'];
        } else {
            $template->orderGetParams = '';
            $template->formOrderParams = [];
        }

        $template->pages_count = $pages_count;
        break;

}

echo $template->render();