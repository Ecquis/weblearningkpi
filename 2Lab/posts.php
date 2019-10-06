<?php

include 'inc/init.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

$template = new Template();

switch ($action) {
    case 'new' :
        $post = new Post;

        if (!empty($_POST)) {
            $post->name = $_POST['post']['name'];

            if ($post->checkout()) {
                $post->save();
                header('Location: ./posts.php');
                exit;
            } else {
                $template->errors = $post->errors;
            }
        }

        $template->name = 'posts/form';
        $template->post = $post;
        break;
    case 'edit' :
        if (empty($_GET['id'])) {
            header('Location: ./posts.php');
            exit;
        }

        $post = new Post($_GET['id']);

        if (!$post->id) {
            header('Location: ./posts.php');
            exit;
        }

        if (!empty($_POST)) {
            $post->name = $_POST['post']['name'];

            if ($post->checkout()) {
                $post->save();
                header('Location: ./posts.php');
                exit;
            } else {
                $template->errors = $post->errors;
            }
        }

        $template->name = 'posts/form';
        $template->post = $post;
        break;
    case 'delete' :
        if (empty($_GET['id'])) {
            header('Location: ./posts.php');
            exit;
        }

        Post::deleteStatic($_GET['id']);
        header('Location: ./posts.php');
        exit;
        break;
    default :
        $template->name = 'posts/list';

        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $posts_count = Post::getCount(isset($_GET['filter']) ? $_GET['filter'] : []);
        $pages_count = ceil($posts_count / 10);

        $template->posts = Post::getList(
            isset($_GET['filter']) ? $_GET['filter'] : [],
            isset($_GET['order']) ? $_GET['order'] : [],
            10 * ($current_page - 1)
        );

        if (isset($_GET['filter'])) {
            $template->filter = $_GET['filter'];

            $filterGetParams = [];
            foreach ($_GET['filter'] as $field => $value) {
                $filterGetParams[] = "filter[{$field}]={$value}";
            }
            $template->filterGetParams = implode('&', $filterGetParams);
        } else {
            $template->filter = [];
            $template->filterGetParams = '';
        }

        $directions = [
            'id' => 'asc',
            'name' => 'asc'
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